<?php

declare(strict_types=1);

namespace App\Livewire\Admin\Portfolio;

use App\Models\Portfolio;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

/**
 * Admin Portfolio Manager (Livewire 3)
 *
 * Provides CRUD operations with validation, file uploads (cover & gallery),
 * search, filter, pagination, and publish/unpublish controls.
 */
class Index extends Component
{
    use WithPagination;
    use WithFileUploads;

    /** Listing state */
    public string $search = '';
    public string $statusFilter = '';

    /** Form state */
    public bool $showModal = false;
    public ?int $editingId = null;

    public string $title = '';
    public string $slug = '';
    public ?string $excerpt = null;
    public ?string $description = null;
    public string $status = 'draft';
    public ?string $meta_title = null;
    public ?string $meta_description = null;
    public string $tagsInput = ''; // Comma-separated tags input

    /** Uploaded files */
    public $coverUpload; // TemporaryUploadedFile|null
    /** @var array<int, mixed> */
    public array $galleryUploads = [];

    /** Current gallery paths (for reordering) */
    /** @var array<int, string> */
    public array $gallery = [];

    /**
     * Validation rules for form inputs.
     * Ensures security by strictly validating fields and file types.
     *
     * @return array<string, string|array<int, string>>
     */
    protected function rules(): array
    {
        $uniqueSlug = 'unique:portfolios,slug';
        if ($this->editingId) {
            $uniqueSlug = 'unique:portfolios,slug,' . $this->editingId;
        }

        return [
            'title' => ['required', 'string', 'max:150'],
            'slug' => ['required', 'string', 'max:160', $uniqueSlug],
            'excerpt' => ['nullable', 'string', 'max:500'],
            'description' => ['nullable', 'string'],
            'status' => ['required', 'in:draft,published,archived'],
            'meta_title' => ['nullable', 'string', 'max:160'],
            'meta_description' => ['nullable', 'string', 'max:300'],
            'tagsInput' => ['nullable', 'string'],
            'coverUpload' => ['nullable', 'image', 'mimes:jpeg,png,webp', 'max:3072'], // max 3MB
            'galleryUploads.*' => ['nullable', 'image', 'mimes:jpeg,png,webp', 'max:4096'], // each max 4MB
        ];
    }

    /** Reset pagination when search/filter changes. */
    public function updatedSearch(): void
    {
        $this->resetPage();
    }

    public function updatedStatusFilter(): void
    {
        $this->resetPage();
    }

    /** Auto-generate slug when title updates (unless editing an existing custom slug). */
    public function updatedTitle(): void
    {
        if (!$this->editingId || $this->slug === '') {
            $this->slug = Portfolio::generateUniqueSlug($this->title);
        }
    }

    /** Open create modal and reset form. */
    public function create(): void
    {
        $this->resetForm();
        $this->showModal = true;
    }

    /** Load portfolio to edit. */
    public function edit(int $id): void
    {
        $portfolio = Portfolio::findOrFail($id);
        $this->editingId = $portfolio->id;
        $this->title = (string) $portfolio->title;
        $this->slug = (string) $portfolio->slug;
        $this->excerpt = $portfolio->excerpt;
        $this->description = $portfolio->description;
        $this->status = (string) $portfolio->status;
        $this->meta_title = $portfolio->meta_title;
        $this->meta_description = $portfolio->meta_description;
        $this->tagsInput = implode(', ', (array) $portfolio->tags ?? []);
        $this->gallery = (array) $portfolio->gallery ?? [];
        $this->showModal = true;
    }

    /** Persist a new portfolio with uploads. */
    public function save(): void
    {
        $this->validate();

        $tags = $this->parseTags($this->tagsInput);

        $portfolio = new Portfolio();
        $portfolio->fill([
            'title' => $this->title,
            'slug' => $this->slug,
            'excerpt' => $this->excerpt,
            'description' => $this->description,
            'status' => $this->status,
            'meta_title' => $this->meta_title,
            'meta_description' => $this->meta_description,
            'tags' => $tags,
            'author_id' => auth()->id(),
        ]);
        $portfolio->save();

        // Handle cover upload
        if ($this->coverUpload) {
            $coverPath = $this->storeCover($portfolio->id);
            $portfolio->cover_image = $coverPath;
        }

        // Handle gallery uploads
        $galleryPaths = $this->storeGallery($portfolio->id);
        if (!empty($galleryPaths)) {
            $portfolio->gallery = $galleryPaths;
        }

        // Manage publish state
        if ($portfolio->status === 'published') {
            $portfolio->published_at = now();
        }

        $portfolio->save();

        $this->resetForm();
        $this->showModal = false;
        session()->flash('message', 'Portfolio created successfully.');
    }

    /** Update an existing portfolio. */
    public function update(): void
    {
        if (!$this->editingId) {
            return;
        }

        $this->validate();
        $portfolio = Portfolio::findOrFail($this->editingId);
        $tags = $this->parseTags($this->tagsInput);

        $portfolio->fill([
            'title' => $this->title,
            'slug' => $this->slug,
            'excerpt' => $this->excerpt,
            'description' => $this->description,
            'status' => $this->status,
            'meta_title' => $this->meta_title,
            'meta_description' => $this->meta_description,
            'tags' => $tags,
        ]);

        // Update publish timestamp accordingly
        if ($portfolio->status === 'published' && !$portfolio->published_at) {
            $portfolio->published_at = now();
        }
        if ($portfolio->status !== 'published') {
            $portfolio->published_at = null;
        }

        // Cover upload
        if ($this->coverUpload) {
            $coverPath = $this->storeCover($portfolio->id);
            $portfolio->cover_image = $coverPath;
        }

        // Gallery uploads (append to existing order)
        $newGallery = $this->storeGallery($portfolio->id);
        if (!empty($newGallery)) {
            $portfolio->gallery = array_values(array_merge((array) $portfolio->gallery ?? [], $newGallery));
        }

        // Apply reordering from UI (this->gallery holds current order)
        if (!empty($this->gallery)) {
            $portfolio->gallery = array_values($this->gallery);
        }

        $portfolio->save();

        $this->resetForm();
        $this->showModal = false;
        session()->flash('message', 'Portfolio updated successfully.');
    }

    /** Delete portfolio and its files. */
    public function delete(int $id): void
    {
        $portfolio = Portfolio::findOrFail($id);

        // Security: Remove files from public disk
        $baseDir = 'portfolios/' . $portfolio->id;
        try {
            \Storage::disk('public')->delete($portfolio->cover_image ?? '');
            foreach ((array) $portfolio->gallery ?? [] as $path) {
                \Storage::disk('public')->delete($path);
            }
            \Storage::disk('public')->deleteDirectory($baseDir);
        } catch (\Throwable $e) {
            // Log but do not expose details to user
            \Log::warning('Failed to delete portfolio files: ' . $e->getMessage());
        }

        $portfolio->delete();
        session()->flash('message', 'Portfolio deleted successfully.');
        $this->resetPage();
    }

    /** Publish action */
    public function publish(int $id): void
    {
        $portfolio = Portfolio::findOrFail($id);
        $portfolio->publish();
        session()->flash('message', 'Portfolio published.');
    }

    /** Unpublish action */
    public function unpublish(int $id): void
    {
        $portfolio = Portfolio::findOrFail($id);
        $portfolio->unpublish();
        session()->flash('message', 'Portfolio moved to draft.');
    }

    /** Move gallery item up. */
    public function moveGalleryUp(int $index): void
    {
        if ($index <= 0 || $index >= count($this->gallery)) {
            return;
        }
        [$this->gallery[$index - 1], $this->gallery[$index]] = [$this->gallery[$index], $this->gallery[$index - 1]];
    }

    /** Move gallery item down. */
    public function moveGalleryDown(int $index): void
    {
        if ($index < 0 || $index >= count($this->gallery) - 1) {
            return;
        }
        [$this->gallery[$index + 1], $this->gallery[$index]] = [$this->gallery[$index], $this->gallery[$index + 1]];
    }

    /** Reset form state to defaults. */
    private function resetForm(): void
    {
        $this->reset([
            'editingId', 'title', 'slug', 'excerpt', 'description', 'status', 'meta_title', 'meta_description',
            'tagsInput', 'coverUpload', 'galleryUploads', 'gallery',
        ]);
        $this->status = 'draft';
    }

    /** Parse comma-separated tags into clean array. */
    private function parseTags(?string $input): array
    {
        $tags = [];
        foreach (explode(',', (string) $input) as $tag) {
            $t = trim($tag);
            if ($t !== '') {
                $tags[] = $t;
            }
        }
        // limit tags to reasonable count
        return array_slice(array_unique($tags), 0, 12);
    }

    /** Store cover image securely under public disk. */
    private function storeCover(int $portfolioId): string
    {
        $dir = "portfolios/{$portfolioId}";
        $ext = $this->coverUpload->getClientOriginalExtension();
        $filename = 'cover_' . Str::random(12) . '.' . $ext;
        return $this->coverUpload->storeAs($dir, $filename, 'public');
    }

    /** Store gallery uploads and return stored paths in order. */
    private function storeGallery(int $portfolioId): array
    {
        $paths = [];
        foreach ($this->galleryUploads as $upload) {
            if (!$upload) {
                continue;
            }
            $dir = "portfolios/{$portfolioId}/gallery";
            $ext = $upload->getClientOriginalExtension();
            $filename = 'img_' . Str::random(12) . '.' . $ext;
            $paths[] = $upload->storeAs($dir, $filename, 'public');
        }
        return $paths;
    }

    /** Render list with search & filter */
    public function render()
    {
        $query = Portfolio::query()->orderByDesc('created_at');
        if ($this->search !== '') {
            $s = $this->search;
            $query->where(function ($q) use ($s): void {
                $q->where('title', 'like', "%{$s}%")
                    ->orWhere('excerpt', 'like', "%{$s}%");
            });
        }
        if (in_array($this->statusFilter, ['draft', 'published', 'archived'], true)) {
            $query->where('status', $this->statusFilter);
        }

        $items = $query->paginate(10);

        return view('livewire.admin.portfolio.index', [
            'items' => $items,
        ]);
    }
}

