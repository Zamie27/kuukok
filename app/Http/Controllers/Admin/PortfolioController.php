<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Portfolio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PortfolioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (!Gate::allows('access-admin')) {
            abort(403);
        }

        $portfolios = Portfolio::orderByDesc('created_at')->paginate(15);
        return view('admin.portfolios.index', compact('portfolios'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (!Gate::allows('access-admin')) {
            abort(403);
        }
        return view('admin.portfolios.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (!Gate::allows('access-admin')) {
            abort(403);
        }

        $data = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255', 'unique:portfolios,slug'],
            'description' => ['nullable', 'string'],
            'cover_image' => ['nullable', 'image', 'mimes:jpeg,png,webp', 'max:5120'], // 5MB
            'gallery.*' => ['nullable', 'image', 'mimes:jpeg,png,webp', 'max:5120'],
            'tags' => ['nullable', 'string'], // Comma separated string input
            'status' => ['required', 'in:draft,published,archived'],
            'meta_title' => ['nullable', 'string', 'max:255'],
            'meta_description' => ['nullable', 'string', 'max:500'],
        ]);

        if (empty($data['slug'])) {
            $data['slug'] = Portfolio::generateUniqueSlug($data['title']);
        }

        $data['author_id'] = auth()->id();

        // Handle tags
        if (!empty($data['tags'])) {
            $data['tags'] = array_map('trim', explode(',', $data['tags']));
        } else {
            $data['tags'] = [];
        }

        $portfolio = new Portfolio($data);

        if ($data['status'] === 'published') {
            $portfolio->published_at = now();
        }

        $portfolio->save();

        // Handle Cover Image
        if ($request->hasFile('cover_image')) {
            $path = $request->file('cover_image')->store('portfolio/' . $portfolio->id, 'public');
            $portfolio->cover_image = $path;
            $portfolio->save();
        }

        // Handle Gallery
        if ($request->hasFile('gallery')) {
            $galleryPaths = [];
            foreach ($request->file('gallery') as $file) {
                $galleryPaths[] = $file->store('portfolio/' . $portfolio->id . '/gallery', 'public');
            }
            $portfolio->gallery = $galleryPaths;
            $portfolio->save();
        }

        return redirect()->route('admin.portfolios.index')
            ->with('success', 'Portfolio item created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Portfolio $portfolio)
    {
        if (!Gate::allows('access-admin')) {
            abort(403);
        }
        return view('admin.portfolios.edit', compact('portfolio'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Portfolio $portfolio)
    {
        if (!Gate::allows('access-admin')) {
            abort(403);
        }

        $data = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'slug' => ['required', 'string', 'max:255', 'unique:portfolios,slug,' . $portfolio->id],
            'description' => ['nullable', 'string'],
            'cover_image' => ['nullable', 'image', 'mimes:jpeg,png,webp', 'max:5120'],
            'gallery.*' => ['nullable', 'image', 'mimes:jpeg,png,webp', 'max:5120'],
            'tags' => ['nullable', 'string'],
            'status' => ['required', 'in:draft,published,archived'],
            'meta_title' => ['nullable', 'string', 'max:255'],
            'meta_description' => ['nullable', 'string', 'max:500'],
        ]);

        // Handle tags
        if (isset($data['tags'])) {
            $data['tags'] = array_map('trim', explode(',', $data['tags']));
        } else {
            $data['tags'] = $portfolio->tags; // Keep existing if not sent? Or empty?
            // Usually if field is present but empty, it means clear tags.
            // If field is missing, it might mean don't update.
            // But HTML forms always send field if present.
            // Let's assume if 'tags' is in request, we update.
            if ($request->has('tags')) {
                $data['tags'] = !empty($request->input('tags')) ? array_map('trim', explode(',', $request->input('tags'))) : [];
            }
        }

        $portfolio->fill($data);

        if ($portfolio->status === 'published' && !$portfolio->published_at) {
            $portfolio->published_at = now();
        }

        $portfolio->save();

        // Handle Gallery Removal
        if ($request->has('remove_gallery_images')) {
            $currentGallery = $portfolio->gallery ?? [];
            $imagesToRemove = $request->input('remove_gallery_images');

            $newGallery = [];
            foreach ($currentGallery as $image) {
                if (in_array($image, $imagesToRemove)) {
                    Storage::disk('public')->delete($image);
                } else {
                    $newGallery[] = $image;
                }
            }
            $portfolio->gallery = $newGallery;
            $portfolio->save();
        }

        if ($request->hasFile('cover_image')) {
            // Delete old cover if exists
            if ($portfolio->cover_image) {
                Storage::disk('public')->delete($portfolio->cover_image);
            }
            $path = $request->file('cover_image')->store('portfolio/' . $portfolio->id, 'public');
            $portfolio->cover_image = $path;
            $portfolio->save();
        }

        if ($request->hasFile('gallery')) {
            // Append to existing gallery or replace?
            // Usually simple impl appends. To replace, we might need a "clear gallery" option.
            // For now let's just append.
            $currentGallery = $portfolio->gallery ?? [];
            foreach ($request->file('gallery') as $file) {
                $currentGallery[] = $file->store('portfolio/' . $portfolio->id . '/gallery', 'public');
            }
            $portfolio->gallery = $currentGallery;
            $portfolio->save();
        }

        return redirect()->route('admin.portfolios.index')
            ->with('success', 'Portfolio item updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Portfolio $portfolio)
    {
        if (!Gate::allows('access-admin')) {
            abort(403);
        }

        // Delete images
        if ($portfolio->cover_image) {
            Storage::disk('public')->delete($portfolio->cover_image);
        }
        if ($portfolio->gallery) {
            foreach ($portfolio->gallery as $image) {
                Storage::disk('public')->delete($image);
            }
        }
        // Delete folder
        Storage::disk('public')->deleteDirectory('portfolios/' . $portfolio->id);

        $portfolio->delete();

        return redirect()->route('admin.portfolios.index')
            ->with('success', 'Portfolio item deleted successfully.');
    }
}
