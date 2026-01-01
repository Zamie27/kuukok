<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $filters = [
            'search' => $request->input('q') ?? $request->input('search'),
            'category' => $request->input('category'),
            'tag' => $request->input('tag'),
        ];

        $query = Post::published()
            ->filter($filters)
            ->orderByDesc('published_at');

        $posts = $query->paginate(9)->withQueryString();

        $recent_posts = Post::published()
            ->orderByDesc('published_at')
            ->take(5)
            ->get();

        $categories = Post::published()
            ->whereNotNull('category')
            ->select('category', DB::raw('count(*) as total'))
            ->groupBy('category')
            ->get();

        $popular_tags = Post::published()
            ->whereNotNull('tags')
            ->get()
            ->flatMap(function ($post) {
                return $post->tags ?? [];
            })
            ->countBy()
            ->sortDesc()
            ->take(10);

        return view('blog', [
            'posts' => $posts,
            'recent_posts' => $recent_posts,
            'categories' => $categories,
            'popular_tags' => $popular_tags,
            'search' => $filters['search'],
            'current_category' => $filters['category'],
            'current_tag' => $filters['tag'],
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post): View
    {
        abort_if($post->status !== 'published', 404);

        $post->load(['author.profile']);

        $key = 'viewed_post_' . $post->id;
        if (!session()->has($key)) {
            $post->increment('views');
            session()->put($key, true);
        }

        $recent_posts = Post::where('status', 'published')
            ->orderByDesc('published_at')
            ->take(5)
            ->get();

        $related_posts = Post::published()
            ->where('id', '!=', $post->id)
            ->where(function ($query) use ($post) {
                if (!empty($post->tags)) {
                    foreach ($post->tags as $tag) {
                        $query->orWhereJsonContains('tags', $tag);
                    }
                }
            })
            ->take(4)
            ->get();

        // If fewer than 2 posts found by tags, fill with same category
        if ($related_posts->count() < 2 && $post->category) {
            $more_posts = Post::published()
                ->where('id', '!=', $post->id)
                ->whereNotIn('id', $related_posts->pluck('id'))
                ->where('category', $post->category)
                ->take(4 - $related_posts->count())
                ->get();

            $related_posts = $related_posts->merge($more_posts);
        }

        // If still fewer than 2, fill with recent posts
        if ($related_posts->count() < 2) {
            $more_posts = Post::published()
                ->where('id', '!=', $post->id)
                ->whereNotIn('id', $related_posts->pluck('id'))
                ->latest('published_at')
                ->take(4 - $related_posts->count())
                ->get();

            $related_posts = $related_posts->merge($more_posts);
        }

        return view('article', [
            'post' => $post,
            'title' => $post->meta_title ?? $post->title,
            'recent_posts' => $recent_posts, // Keep for backward compatibility if used elsewhere, or remove
            'related_posts' => $related_posts,
        ]);
    }

    public function trackClick(Request $request, Post $post)
    {
        $type = $request->input('type');

        if ($type === 'whatsapp') {
            $post->increment('whatsapp_clicks');
        } elseif ($type === 'share') {
            $post->increment('share_clicks');
        } elseif ($type === 'time') {
            // Validate seconds to prevent abuse (e.g., max 60s per request)
            $seconds = (int) $request->input('seconds', 30);
            if ($seconds > 0 && $seconds <= 60) {
                $post->increment('total_seconds_read', $seconds);
            }
        }

        return response()->json(['success' => true]);
    }
}
