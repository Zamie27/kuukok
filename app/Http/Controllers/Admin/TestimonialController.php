<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Testimonial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class TestimonialController extends Controller
{
    public function index()
    {
        if (!Gate::allows('access-admin')) {
            abort(403);
        }
        $items = Testimonial::orderBy('sort_order')->get();
        return view('admin.testimonials.index', compact('items'));
    }

    public function create()
    {
        if (!Gate::allows('access-admin')) {
            abort(403);
        }
        return view('admin.testimonials.create');
    }

    public function store(Request $request)
    {
        if (!Gate::allows('access-admin')) {
            abort(403);
        }
        $data = $request->validate([
            'name' => ['required', 'string', 'max:120'],
            'role' => ['nullable', 'string', 'max:120'],
            'content' => ['required', 'string'],
            'rating' => ['required', 'integer', 'min:1', 'max:5'],
            'photo' => ['nullable', 'image', 'mimes:jpeg,png,webp', 'max:4096'],
            'status' => ['required', 'in:active,inactive'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
            'is_masked' => ['nullable', 'boolean'],
        ]);
        $data['is_masked'] = $request->boolean('is_masked');
        $item = new Testimonial($data);
        $item->save();
        if ($request->hasFile('photo')) {
            $path = $request->file('photo')->store('testimonials/' . $item->id, 'public');
            $item->photo = $path;
            $item->save();
        }
        return redirect()->route('admin.testimonials.index');
    }

    public function edit(Testimonial $testimonial)
    {
        if (!Gate::allows('access-admin')) {
            abort(403);
        }
        return view('admin.testimonials.edit', ['item' => $testimonial]);
    }

    public function update(Request $request, Testimonial $testimonial)
    {
        if (!Gate::allows('access-admin')) {
            abort(403);
        }
        $data = $request->validate([
            'name' => ['required', 'string', 'max:120'],
            'role' => ['nullable', 'string', 'max:120'],
            'content' => ['required', 'string'],
            'rating' => ['required', 'integer', 'min:1', 'max:5'],
            'photo' => ['nullable', 'image', 'mimes:jpeg,png,webp', 'max:4096'],
            'status' => ['required', 'in:active,inactive'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
            'is_masked' => ['nullable', 'boolean'],
        ]);
        $data['is_masked'] = $request->boolean('is_masked');
        $testimonial->fill($data)->save();
        if ($request->hasFile('photo')) {
            $path = $request->file('photo')->store('testimonials/' . $testimonial->id, 'public');
            $testimonial->photo = $path;
            $testimonial->save();
        }
        return redirect()->route('admin.testimonials.index');
    }

    public function destroy(Testimonial $testimonial)
    {
        if (!Gate::allows('access-admin')) {
            abort(403);
        }
        $testimonial->delete();
        return redirect()->route('admin.testimonials.index');
    }
}
