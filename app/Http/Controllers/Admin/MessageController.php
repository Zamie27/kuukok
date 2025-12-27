<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class MessageController extends Controller
{
    public function index()
    {
        if (!Gate::allows('access-admin')) {
            abort(403);
        }
        $messages = Message::orderByDesc('created_at')->paginate(20);
        return view('admin.messages.index', compact('messages'));
    }

    public function show(Message $message)
    {
        if (!Gate::allows('access-admin')) {
            abort(403);
        }
        return view('admin.messages.show', compact('message'));
    }

    public function markRead(Message $message)
    {
        if (!Gate::allows('access-admin')) {
            abort(403);
        }
        $message->status = 'read';
        $message->save();
        return redirect()->route('admin.messages.index');
    }

    public function destroy(Message $message)
    {
        if (!Gate::allows('access-admin')) {
            abort(403);
        }
        $message->delete();
        return redirect()->route('admin.messages.index');
    }
}
