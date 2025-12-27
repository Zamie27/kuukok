<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Message;
use App\Models\Portfolio;
use App\Models\Post;
use Illuminate\Support\Facades\Gate;

class DashboardController extends Controller
{
    public function __invoke()
    {
        if (!Gate::allows('access-admin')) {
            abort(403);
        }

        $stats = [
            'posts' => Post::count(),
            'portfolios' => Portfolio::count(),
            'messages_unread' => Message::where('status', 'unread')->count(),
        ];

        $popularPosts = Post::orderByDesc('views')->take(5)->get();
        $recentMessages = Message::latest()->take(5)->get();

        return view('admin.dashboard', compact('stats', 'popularPosts', 'recentMessages'));
    }
}
