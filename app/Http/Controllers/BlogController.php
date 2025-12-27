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
        $query = Post::query()
            ->where('status', 'published')
            ->orderByDesc('published_at');

        if ($search = $request->string('q')->toString()) {
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                    ->orWhere('excerpt', 'like', "%{$search}%");
            });
        }

        $posts = $query->paginate(9)->withQueryString();
        $recent_posts = Post::where('status', 'published')
            ->orderByDesc('published_at')
            ->take(5)
            ->get();

        $categories = Post::where('status', 'published')
            ->whereNotNull('category')
            ->select('category', DB::raw('count(*) as total'))
            ->groupBy('category')
            ->get();

        return view('blog', [
            'posts' => $posts,
            'recent_posts' => $recent_posts,
            'categories' => $categories,
            'search' => $search,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post): View
    {
        abort_if($post->status !== 'published', 404);

        $key = 'viewed_post_' . $post->id;
        if (!session()->has($key)) {
            $post->increment('views');
            session()->put($key, true);
        }

        $recent_posts = Post::where('status', 'published')
            ->orderByDesc('published_at')
            ->take(5)
            ->get();

        $related_posts = Post::where('status', 'published')
            ->where('id', '!=', $post->id)
            ->when($post->category, function ($query) use ($post) {
                return $query->where('category', $post->category);
            })
            ->inRandomOrder()
            ->take(2)
            ->get();

        return view('article', [
            'post' => $post,
            'title' => $post->meta_title ?? $post->title,
            'recent_posts' => $recent_posts,
            'related_posts' => $related_posts,
        ]);
    }
}
