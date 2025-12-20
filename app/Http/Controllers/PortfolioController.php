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
            ->where('status', 'published')
            ->orderByDesc('published_at')
            ->orderByDesc('created_at');

        if ($search = $request->string('q')->toString()) {
            $query->where(function ($q) use ($search): void {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('excerpt', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
        }

        /** @var LengthAwarePaginator $portfolios */
        $portfolios = $query->paginate(9)->withQueryString();

        return view('portfolio.index', [
            'title' => 'Portfolio',
            'portfolios' => $portfolios,
            'search' => $search,
        ]);
    }

    /**
     * Display a single published portfolio item by slug.
     */
    public function show(Portfolio $portfolio): View
    {
        abort_if($portfolio->status !== 'published', 404);

        return view('portfolio.show', [
            'title' => $portfolio->meta_title ?: $portfolio->title,
            'portfolio' => $portfolio,
        ]);
    }
}

