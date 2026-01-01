<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Message;
use App\Models\Portfolio;
use App\Models\Post;
use App\Models\Visitor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class DashboardController extends Controller
{
    public function __invoke(Request $request)
    {
        if (!Gate::allows('access-admin')) {
            abort(403);
        }

        // Visitor Stats
        $todayVisitors = Visitor::where('visit_date', now()->toDateString())->count();
        $totalVisitors = Visitor::count(); // Total unique visits (IP + Date combinations)

        $stats = [
            'posts' => Post::count(),
            'portfolios' => Portfolio::count(),
            'messages_unread' => Message::where('status', 'unread')->count(),
            'total_views' => Post::sum('views'),
            'total_cta' => Post::sum('whatsapp_clicks') + Post::sum('share_clicks'),
            'total_read_time' => Post::sum(\DB::raw('views * read_time')),
            'today_visitors' => $todayVisitors,
            'total_visitors' => $totalVisitors,
        ];

        // Top Lists (kept for quick widgets)
        $popularPosts = Post::orderByDesc('views')->take(5)->get();
        $longestReadPosts = Post::orderByDesc('read_time')->take(5)->get();
        $mostCtaPosts = Post::select('*')
            ->selectRaw('whatsapp_clicks + share_clicks as total_cta')
            ->orderByDesc('total_cta')
            ->take(5)
            ->get();

        $recentMessages = Message::latest()->take(5)->get();

        // Full Analytics Table with Sorting
        $sort = $request->input('sort', 'views');
        $direction = $request->input('direction', 'desc');
        $validSorts = ['title', 'views', 'read_time', 'total_cta', 'created_at'];

        if (!in_array($sort, $validSorts)) {
            $sort = 'views';
        }
        if (!in_array($direction, ['asc', 'desc'])) {
            $direction = 'desc';
        }

        $analyticsQuery = Post::query();

        if ($sort === 'total_cta') {
            $analyticsQuery->select('*')
                ->selectRaw('whatsapp_clicks + share_clicks as total_cta')
                ->orderBy('total_cta', $direction);
        } else {
            $analyticsQuery->orderBy($sort, $direction);
        }

        $analyticsPosts = $analyticsQuery->paginate(10)->withQueryString();

        return view('admin.dashboard', compact(
            'stats',
            'popularPosts',
            'longestReadPosts',
            'mostCtaPosts',
            'recentMessages',
            'analyticsPosts',
            'sort',
            'direction'
        ));
    }
}
