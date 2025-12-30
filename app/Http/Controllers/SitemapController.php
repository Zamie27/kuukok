<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Portfolio;
use App\Models\Post;
use Illuminate\Support\Facades\URL;
use Illuminate\Http\Response;

class SitemapController extends Controller
{
    public function index(): Response
    {
        $urls = [];

        $urls[] = [URL::to('/'), now()];
        $urls[] = [route('about.index'), now()];
        $urls[] = [route('portfolio.index'), now()];
        $urls[] = [route('pricing.index'), now()];
        $urls[] = [route('blog.index'), now()];
        $urls[] = [route('contact.index'), now()];

        Portfolio::where('status', 'published')
            ->orderByDesc('published_at')
            ->get()
            ->each(function ($p) use (&$urls) {
                $urls[] = [route('portfolio.show', $p), $p->updated_at ?? $p->created_at];
            });

        Post::where('status', 'published')
            ->orderByDesc('published_at')
            ->get()
            ->each(function ($post) use (&$urls) {
                $urls[] = [route('blog.show', $post), $post->updated_at ?? $post->created_at];
            });

        $xml = '<?xml version="1.0" encoding="UTF-8"?>';
        $xml .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';

        foreach ($urls as [$loc, $lastmod]) {
            $xml .= '<url>';
            $xml .= '<loc>' . e($loc) . '</loc>';
            $xml .= '<lastmod>' . ($lastmod ? $lastmod->toAtomString() : now()->toAtomString()) . '</lastmod>';
            $xml .= '<changefreq>weekly</changefreq>';
            $xml .= '<priority>0.8</priority>';
            $xml .= '</url>';
        }

        $xml .= '</urlset>';

        return response($xml, 200)->header('Content-Type', 'application/xml');
    }
}

