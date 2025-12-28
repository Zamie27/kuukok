<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Portfolio;
use App\Models\Profile;
use App\Models\TechStack;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;

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
        $techStacks = TechStack::all();
        $profiles = Profile::with('user')->get(); // Get profiles for team selection

        // Get tags from Settings
        $settingTags = explode(',', Setting::getValue('portfolio_tags', 'Web,Mobile,Design'));

        // Get used tags from Database
        $dbTags = Portfolio::pluck('tags')->flatten()->unique()->filter()->values()->toArray();

        // Merge and unique
        $availableTags = array_unique(array_merge($settingTags, $dbTags));
        sort($availableTags);

        return view('admin.portfolios.create', compact('techStacks', 'profiles', 'availableTags'));
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
            'excerpt' => ['nullable', 'string'],
            'cover_image' => ['nullable', 'image', 'mimes:jpeg,png,webp', 'max:5120'], // 5MB
            'gallery.*' => ['nullable', 'image', 'mimes:jpeg,png,webp', 'max:5120'],
            'tags' => ['nullable', 'array'], // Now array from multi-select
            'status' => ['required', 'in:draft,published,archived'],
            'meta_title' => ['nullable', 'string', 'max:255'],
            'meta_description' => ['nullable', 'string', 'max:500'],

            // New Fields
            'client_name' => ['nullable', 'string', 'max:255'],
            'start_month' => ['nullable', 'integer', 'between:1,12'],
            'start_year' => ['nullable', 'integer', 'min:2000', 'max:' . (date('Y') + 5)],
            'end_month' => ['nullable', 'integer', 'between:1,12'],
            'end_year' => ['nullable', 'integer', 'min:2000', 'max:' . (date('Y') + 5)],
            'project_status' => ['nullable', 'string', 'in:Dalam Pengerjaan,Selesai,Ditunda'],
            'live_demo_link' => ['nullable', 'url'],
            'team_size' => ['nullable', 'integer', 'min:1'],
            'is_personal_project' => ['boolean'],
            'project_roles' => ['nullable', 'array'],
            'project_roles.*' => ['string', 'max:50'],
            'tech_stacks' => ['nullable', 'array'],
            'tech_stacks.*' => ['exists:tech_stacks,id'],
            'team_members' => ['nullable', 'array'],
            'team_members.*.profile_id' => ['required', 'exists:profiles,id'],
            'team_members.*.role' => ['nullable', 'string'],
        ]);

        // Date Validation
        if (!empty($request->start_year) && !empty($request->end_year)) {
            $start = Carbon::createFromDate($request->start_year, $request->start_month ?? 1, 1);
            $end = Carbon::createFromDate($request->end_year, $request->end_month ?? 1, 1);

            if ($end->lt($start)) {
                return back()->withErrors(['end_year' => 'End date cannot be before start date.'])->withInput();
            }
        }

        if (empty($data['slug'])) {
            $data['slug'] = Portfolio::generateUniqueSlug($data['title']);
        }

        // Auto-generate SEO fields if empty
        if (empty($data['meta_title'])) {
            $data['meta_title'] = Str::limit($data['title'], 60);
        }
        if (empty($data['meta_description'])) {
            // Prefer excerpt, fallback to description (stripped tags)
            $source = !empty($data['excerpt']) ? $data['excerpt'] : strip_tags($data['description'] ?? '');
            $data['meta_description'] = Str::limit($source, 160);
        }

        $data['author_id'] = auth()->id();
        $data['is_personal_project'] = $request->boolean('is_personal_project');

        // Handle dates
        if (!empty($request->start_month) && !empty($request->start_year)) {
            $data['start_date'] = Carbon::createFromDate($request->start_year, $request->start_month, 1)->startOfMonth()->format('Y-m-d');
        }
        if (!empty($request->end_month) && !empty($request->end_year)) {
            $data['end_date'] = Carbon::createFromDate($request->end_year, $request->end_month, 1)->endOfMonth()->format('Y-m-d');
        }

        // Handle tags (already array if from select2, but just in case)
        if (isset($data['tags']) && !is_array($data['tags'])) {
            $data['tags'] = array_map('trim', explode(',', $data['tags']));
        }

        // Remove special handling fields from data to prevent raw saving
        $galleryFiles = $data['gallery'] ?? null;
        $coverImageFile = $data['cover_image'] ?? null;
        $techStacksData = $data['tech_stacks'] ?? null;
        $teamMembersData = $data['team_members'] ?? null;

        unset($data['gallery'], $data['cover_image'], $data['tech_stacks'], $data['team_members']);

        $portfolio = new Portfolio($data);

        if ($data['status'] === 'published') {
            $portfolio->published_at = now();
        }

        $portfolio->save();

        // Handle Tech Stacks
        if (!empty($techStacksData)) {
            $portfolio->techStacks()->sync($techStacksData);
        }

        // Handle Team Members
        if (!empty($teamMembersData)) {
            $syncData = [];
            foreach ($teamMembersData as $member) {
                if (isset($member['profile_id'])) {
                    $syncData[$member['profile_id']] = ['role' => $member['role'] ?? null];
                }
            }
            $portfolio->teamMembers()->sync($syncData);
        }

        // Handle Cover Image with consistent naming
        if ($request->hasFile('cover_image')) {
            try {
                $directory = 'portfolios/' . $portfolio->id;
                Storage::disk('public')->makeDirectory($directory);

                $file = $request->file('cover_image');
                $filename = 'cover-' . Str::random(8) . '.' . $file->getClientOriginalExtension();
                $path = $file->storeAs($directory, $filename, 'public');

                if (!$path) {
                    throw new \Exception('Failed to store cover image.');
                }

                $portfolio->cover_image = $path;
                $portfolio->save();
            } catch (\Exception $e) {
                \Log::error('Portfolio Cover Upload Error: ' . $e->getMessage());
                return back()->withErrors(['cover_image' => 'Failed to upload cover image. Please try again.'])->withInput();
            }
        }

        // Handle Gallery with consistent naming
        if ($request->hasFile('gallery')) {
            try {
                $directory = 'portfolios/' . $portfolio->id;
                Storage::disk('public')->makeDirectory($directory);

                $galleryPaths = [];
                foreach ($request->file('gallery') as $index => $file) {
                    $filename = 'gallery-' . ($index + 1) . '-' . Str::random(8) . '.' . $file->getClientOriginalExtension();
                    $path = $file->storeAs($directory, $filename, 'public');

                    if (!$path) {
                        throw new \Exception('Failed to store gallery image ' . $file->getClientOriginalName());
                    }

                    $galleryPaths[] = $path;
                }
                $portfolio->gallery = $galleryPaths;
                $portfolio->save();
            } catch (\Exception $e) {
                \Log::error('Portfolio Gallery Upload Error: ' . $e->getMessage());
                return back()->withErrors(['gallery' => 'Failed to upload gallery images. Please try again.'])->withInput();
            }
        }

        if ($request->input('action') === 'preview') {
            return redirect()->route('portfolio.show', $portfolio->slug)
                ->with('success', 'Portfolio created. Previewing...');
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

        $techStacks = TechStack::all();
        $profiles = Profile::with('user')->get();

        // Get tags from Settings
        $settingTags = explode(',', Setting::getValue('portfolio_tags', 'Web,Mobile,Design'));

        // Get used tags from Database
        $dbTags = Portfolio::pluck('tags')->flatten()->unique()->filter()->values()->toArray();

        // Merge and unique
        $availableTags = array_unique(array_merge($settingTags, $dbTags));
        sort($availableTags);

        $portfolio->load(['techStacks', 'teamMembers']);

        return view('admin.portfolios.edit', compact('portfolio', 'techStacks', 'profiles', 'availableTags'));
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
            'slug' => ['nullable', 'string', 'max:255', 'unique:portfolios,slug,' . $portfolio->id],
            'description' => ['nullable', 'string'],
            'excerpt' => ['nullable', 'string'],
            'cover_image' => ['nullable', 'image', 'mimes:jpeg,png,webp', 'max:5120'], // 5MB
            'gallery.*' => ['nullable', 'image', 'mimes:jpeg,png,webp', 'max:5120'],
            'tags' => ['nullable', 'array'],
            'status' => ['required', 'in:draft,published,archived'],
            'meta_title' => ['nullable', 'string', 'max:255'],
            'meta_description' => ['nullable', 'string', 'max:500'],
            // New Fields
            'client_name' => ['nullable', 'string', 'max:255'],
            'start_month' => ['nullable', 'integer', 'between:1,12'],
            'start_year' => ['nullable', 'integer', 'min:2000', 'max:' . (date('Y') + 5)],
            'end_month' => ['nullable', 'integer', 'between:1,12'],
            'end_year' => ['nullable', 'integer', 'min:2000', 'max:' . (date('Y') + 5)],
            'project_status' => ['nullable', 'string', 'in:Dalam Pengerjaan,Selesai,Ditunda'],
            'live_demo_link' => ['nullable', 'url'],
            'team_size' => ['nullable', 'integer', 'min:1'],
            'is_personal_project' => ['boolean'],
            'project_roles' => ['nullable', 'array'],
            'project_roles.*' => ['string', 'max:50'],
            'tech_stacks' => ['nullable', 'array'],
            'tech_stacks.*' => ['exists:tech_stacks,id'],
            'team_members' => ['nullable', 'array'],
            'team_members.*.profile_id' => ['required', 'exists:profiles,id'],
            'team_members.*.role' => ['nullable', 'string'],
        ]);

        // Date Validation
        if (!empty($request->start_year) && !empty($request->end_year)) {
            $start = Carbon::createFromDate($request->start_year, $request->start_month ?? 1, 1);
            $end = Carbon::createFromDate($request->end_year, $request->end_month ?? 1, 1);

            if ($end->lt($start)) {
                return back()->withErrors(['end_year' => 'End date cannot be before start date.'])->withInput();
            }
        }

        if (empty($data['slug'])) {
            $data['slug'] = Portfolio::generateUniqueSlug($data['title'], true);
        }

        // Auto-generate SEO fields if empty
        if (empty($data['meta_title'])) {
            $data['meta_title'] = Str::limit($data['title'], 60);
        }
        if (empty($data['meta_description'])) {
            // Prefer excerpt, fallback to description (stripped tags)
            $source = !empty($data['excerpt']) ? $data['excerpt'] : strip_tags($data['description'] ?? '');
            $data['meta_description'] = Str::limit($source, 160);
        }

        $data['is_personal_project'] = $request->boolean('is_personal_project');

        // Handle dates
        if (!empty($request->start_month) && !empty($request->start_year)) {
            $data['start_date'] = Carbon::createFromDate($request->start_year, $request->start_month, 1)->startOfMonth()->format('Y-m-d');
        }
        if (!empty($request->end_month) && !empty($request->end_year)) {
            $data['end_date'] = Carbon::createFromDate($request->end_year, $request->end_month, 1)->endOfMonth()->format('Y-m-d');
        }

        // Handle tags
        if (isset($data['tags']) && !is_array($data['tags'])) {
            $data['tags'] = array_map('trim', explode(',', $data['tags']));
        }

        // Handle publishing date
        if ($data['status'] === 'published' && $portfolio->status !== 'published') {
            $data['published_at'] = now();
        }

        // Remove special handling fields
        $techStacksData = $data['tech_stacks'] ?? null;
        $teamMembersData = $data['team_members'] ?? null;

        unset($data['gallery'], $data['cover_image'], $data['tech_stacks'], $data['team_members']);

        $portfolio->fill($data);
        $portfolio->save();

        // Handle Tech Stacks
        if (!empty($techStacksData)) {
            $portfolio->techStacks()->sync($techStacksData);
        } else {
            $portfolio->techStacks()->detach();
        }

        // Handle Team Members
        if (!empty($teamMembersData)) {
            $syncData = [];
            foreach ($teamMembersData as $member) {
                if (isset($member['profile_id'])) {
                    $syncData[$member['profile_id']] = ['role' => $member['role'] ?? null];
                }
            }
            $portfolio->teamMembers()->sync($syncData);
        } else {
            // If empty array or not present, consider clearing?
            // Usually if not present in request (e.g. checkbox unchecked), it means clear.
            // But for dynamic array inputs, we should be careful.
            // If the field is present but empty, clear it.
            if ($request->has('team_members')) {
                $portfolio->teamMembers()->detach();
            }
        }

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

        // Handle Gallery Reordering
        if ($request->has('gallery_order')) {
            $orderedGallery = $request->input('gallery_order');
            $currentGallery = $portfolio->gallery ?? [];

            // Validate that all ordered items exist in current gallery (security check)
            $validOrderedGallery = array_intersect($orderedGallery, $currentGallery);

            // Add any items that might be in current gallery but missing from order (edge case)
            $missingItems = array_diff($currentGallery, $validOrderedGallery);
            $finalGallery = array_merge($validOrderedGallery, $missingItems);

            $portfolio->gallery = $finalGallery;
            $portfolio->save();
        }

        // Handle Cover Image
        if ($request->hasFile('cover_image')) {
            try {
                $directory = 'portfolios/' . $portfolio->id;
                Storage::disk('public')->makeDirectory($directory);

                // Delete old image
                if ($portfolio->cover_image) {
                    Storage::disk('public')->delete($portfolio->cover_image);
                }
                $file = $request->file('cover_image');
                $filename = 'cover-' . Str::random(8) . '.' . $file->getClientOriginalExtension();
                $path = $file->storeAs($directory, $filename, 'public');

                if (!$path) {
                    throw new \Exception('Failed to store cover image.');
                }

                $portfolio->cover_image = $path;
                $portfolio->save();
            } catch (\Exception $e) {
                \Log::error('Portfolio Update Cover Error: ' . $e->getMessage());
                return back()->withErrors(['cover_image' => 'Failed to update cover image.'])->withInput();
            }
        }

        // Handle Gallery Additions
        if ($request->hasFile('gallery')) {
            try {
                $directory = 'portfolios/' . $portfolio->id;
                Storage::disk('public')->makeDirectory($directory);

                $currentGallery = $portfolio->gallery ?? [];
                foreach ($request->file('gallery') as $index => $file) {
                    $filename = 'gallery-' . (count($currentGallery) + $index + 1) . '-' . Str::random(8) . '.' . $file->getClientOriginalExtension();
                    $path = $file->storeAs($directory, $filename, 'public');

                    if (!$path) {
                        throw new \Exception('Failed to store gallery image.');
                    }

                    $currentGallery[] = $path;
                }
                $portfolio->gallery = $currentGallery;
                $portfolio->save();
            } catch (\Exception $e) {
                \Log::error('Portfolio Update Gallery Error: ' . $e->getMessage());
                return back()->withErrors(['gallery' => 'Failed to add gallery images.'])->withInput();
            }
        }

        if ($request->input('action') === 'preview') {
            return redirect()->route('portfolio.show', $portfolio->slug)
                ->with('success', 'Portfolio updated. Previewing...');
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
        Storage::disk('public')->deleteDirectory('portfolios/' . $portfolio->slug); // Legacy cleanup

        $portfolio->delete();

        return redirect()->route('admin.portfolios.index')
            ->with('success', 'Portfolio item deleted successfully.');
    }
}
