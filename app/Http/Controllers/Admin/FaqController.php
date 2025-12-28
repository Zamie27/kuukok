<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Faq;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class FaqController extends Controller
{
    public function index()
    {
        if (!Gate::allows('access-admin')) {
            abort(403);
        }
        $items = Faq::orderBy('sort_order')->get();
        return view('admin.faqs.index', compact('items'));
    }

    public function create()
    {
        if (!Gate::allows('access-admin')) {
            abort(403);
        }
        return view('admin.faqs.create');
    }

    public function store(Request $request)
    {
        if (!Gate::allows('access-admin')) {
            abort(403);
        }
        $data = $request->validate([
            'question' => ['required', 'string', 'max:200'],
            'answer' => ['required', 'string'],
            'active' => ['nullable', 'boolean'],
            'sort_order' => ['nullable', 'integer', 'min:0', 'unique:faqs,sort_order'],
        ], [
            'sort_order.unique' => 'Order sudah ada active',
        ]);
        Faq::create($data);
        return redirect()->route('admin.faqs.index');
    }

    public function edit(Faq $faq)
    {
        if (!Gate::allows('access-admin')) {
            abort(403);
        }
        return view('admin.faqs.edit', ['item' => $faq]);
    }

    public function update(Request $request, Faq $faq)
    {
        if (!Gate::allows('access-admin')) {
            abort(403);
        }
        $data = $request->validate([
            'question' => ['required', 'string', 'max:200'],
            'answer' => ['required', 'string'],
            'active' => ['nullable', 'boolean'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
        ]);

        // Check for order swap
        if (isset($data['sort_order']) && $data['sort_order'] != $faq->sort_order) {
            $existing = Faq::where('sort_order', $data['sort_order'])->first();
            if ($existing) {
                // Swap the sort orders
                $existing->sort_order = $faq->sort_order;
                $existing->save();
            }
        }

        $faq->fill($data)->save();
        return redirect()->route('admin.faqs.index');
    }

    public function destroy(Faq $faq)
    {
        if (!Gate::allows('access-admin')) {
            abort(403);
        }
        $faq->delete();
        return redirect()->route('admin.faqs.index');
    }
}
