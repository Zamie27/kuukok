<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Portfolio;
use App\Models\Post;
use App\Models\Package;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SearchController extends Controller
{
    public function index(Request $request): View
    {
        $q = trim((string) $request->query('q', ''));

        $portfolios = collect();
        $posts = collect();
        $packages = collect();

        if ($q !== '') {
            $portfolios = Portfolio::query()
                ->where(function ($query) use ($q) {
                    $query->where('title', 'like', "%{$q}%")
                        ->orWhere('excerpt', 'like', "%{$q}%");
                })
                ->orderByDesc('published_at')
                ->take(10)
                ->get();

            $posts = Post::query()
                ->where('status', 'published')
                ->where(function ($query) use ($q) {
                    $query->where('title', 'like', "%{$q}%")
                        ->orWhere('content', 'like', "%{$q}%")
                        ->orWhere('meta_description', 'like', "%{$q}%");
                })
                ->orderByDesc('published_at')
                ->take(10)
                ->get();

            $packages = Package::query()
                ->where('name', 'like', "%{$q}%")
                ->orderBy('sort_order')
                ->take(10)
                ->get();
        }

        return view('search', [
            'q' => $q,
            'portfolios' => $portfolios,
            'posts' => $posts,
            'packages' => $packages,
        ]);
    }
}
