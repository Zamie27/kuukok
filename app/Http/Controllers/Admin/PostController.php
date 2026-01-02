<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Str;

class PostController extends Controller
{
    public function index()
    {
        if (!Gate::allows('access-admin')) {
            abort(403);
        }

        $posts = Post::orderByDesc('created_at')->paginate(15);
        return view('admin.posts.index', compact('posts'));
    }

    public function create()
    {
        if (!Gate::allows('access-admin')) {
            abort(403);
        }
        return view('admin.posts.create');
    }

    public function store(Request $request)
    {
        if (!Gate::allows('access-admin')) {
            abort(403);
        }
        $data = $request->validate([
            'title' => ['required', 'string', 'max:160'],
            'slug' => ['nullable', 'string', 'max:180', 'unique:posts,slug'],
            'category' => ['nullable', 'string', 'max:80'],
            'content' => ['required', 'string'],
            'content_blocks' => ['nullable', 'string'],
            'cover_image' => ['nullable', 'image', 'mimes:jpeg,png,webp', 'max:4096'],
            'meta_title' => ['nullable', 'string', 'max:160'],
            'meta_description' => ['nullable', 'string', 'max:300'],
            'keywords' => ['nullable', 'string', 'max:300'],
            'status' => ['required', 'in:draft,published'],
            'tags' => ['nullable', 'string'],
        ]);

        if (empty($data['slug'])) {
            $data['slug'] = Post::generateUniqueSlug($data['title']);
        }
        $data['author_id'] = auth()->id();

        if (isset($data['content_blocks'])) {
            $data['content_blocks'] = json_decode($data['content_blocks'], true);
        }

        if (isset($data['tags'])) {
            $data['tags'] = array_filter(array_map('trim', explode(',', $data['tags'])));
        }

        $post = new Post($data);
        if ($data['status'] === 'published') {
            $post->published_at = now();
        }
        $post->save();

        if ($request->hasFile('cover_image')) {
            $path = $request->file('cover_image')->store('posts/' . $post->id, 'public');
            $post->cover_image = $path;
            $post->save();
        }

        return redirect()->route('admin.posts.index');
    }

    public function edit(Post $post)
    {
        if (!Gate::allows('access-admin')) {
            abort(403);
        }
        return view('admin.posts.edit', compact('post'));
    }

    public function update(Request $request, Post $post)
    {
        if (!Gate::allows('access-admin')) {
            abort(403);
        }
        $data = $request->validate([
            'title' => ['required', 'string', 'max:160'],
            'slug' => ['required', 'string', 'max:180', 'unique:posts,slug,' . $post->id],
            'category' => ['nullable', 'string', 'max:80'],
            'content' => ['required', 'string'],
            'content_blocks' => ['nullable', 'string'],
            'cover_image' => ['nullable', 'image', 'mimes:jpeg,png,webp', 'max:4096'],
            'meta_title' => ['nullable', 'string', 'max:160'],
            'meta_description' => ['nullable', 'string', 'max:300'],
            'keywords' => ['nullable', 'string', 'max:300'],
            'status' => ['required', 'in:draft,published'],
            'tags' => ['nullable', 'string'],
        ]);

        if (isset($data['content_blocks'])) {
            $data['content_blocks'] = json_decode($data['content_blocks'], true);
        }

        if (isset($data['tags'])) {
            $data['tags'] = array_filter(array_map('trim', explode(',', $data['tags'])));
        }

        $post->fill($data);
        if ($post->status === 'published' && !$post->published_at) {
            $post->published_at = now();
        }
        if ($post->status === 'draft') {
            $post->published_at = null;
        }
        $post->save();

        if ($request->hasFile('cover_image')) {
            $path = $request->file('cover_image')->store('articles/' . $post->id, 'public');
            $post->cover_image = $path;
            $post->save();
        }

        return redirect()->route('admin.posts.index');
    }

    public function destroy(Post $post)
    {
        if (!Gate::allows('access-admin')) {
            abort(403);
        }
        $post->delete();
        return redirect()->route('admin.posts.index');
    }

    public function uploadImage(Request $request)
    {
        if (!Gate::allows('access-admin')) {
            abort(403);
        }

        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,webp,jpg|max:5120',
        ]);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('uploads/posts', 'public');
            return response()->json(['url' => asset('storage/' . $path)]);
        }

        return response()->json(['error' => 'No image uploaded'], 400);
    }
}
