<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Portfolio;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

/**
 * Public Portfolio Controller
 *
 * Handles listing and detail pages for published portfolio items.
 */
class PortfolioController extends Controller
{
    /**
     * Display a paginated list of published portfolio items with optional search.
     */
    public function index(Request $request): View
    {
        $query = Portfolio::query()
            ->where('status', 'published');

        // Sorting
        $sort = $request->string('sort', 'newest')->toString();
        match ($sort) {
            'oldest' => $query->orderBy('start_date', 'asc'),
            'newest' => $query->orderBy('start_date', 'desc'),
            default => $query->orderByDesc('published_at'),
        };
        // Always add secondary sort for stability
        $query->orderByDesc('created_at');

        if ($search = $request->string('q')->toString()) {
            $searchLower = strtolower($search);
            $query->where(function ($q) use ($searchLower): void {
                $q->whereRaw('LOWER(title) LIKE ?', ["%{$searchLower}%"])
                    ->orWhereRaw('LOWER(excerpt) LIKE ?', ["%{$searchLower}%"])
                    ->orWhereRaw('LOWER(description) LIKE ?', ["%{$searchLower}%"])
                    ->orWhereRaw('LOWER(tags) LIKE ?', ["%{$searchLower}%"]);
            });
        }

        if ($tag = $request->string('tag')->toString()) {
            $query->whereJsonContains('tags', $tag);
        }

        /** @var LengthAwarePaginator $portfolios */
        $portfolios = $query->paginate(9)->withQueryString();

        return view('portfolio.index', [
            'title' => 'Portfolio',
            'portfolios' => $portfolios,
            'recent_posts' => [], // Add if needed
            'search' => $search,
        ]);
    }

    /**
     * Display the specified portfolio item.
     */
    public function show(Portfolio $portfolio): View
    {
        // If not published and user is not admin/author, 404
        if ($portfolio->status !== 'published' && !auth()->check()) {
            abort(404);
        }

        // Load relationships
        $portfolio->load(['techStacks', 'teamMembers.user']);

        return view('portfolio.show', [
            'portfolio' => $portfolio,
        ]);
    }
}
