<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Package;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class PackageController extends Controller
{
    public function index()
    {
        if (!Gate::allows('access-admin')) {
            abort(403);
        }
        $items = Package::orderBy('sort_order')->get();
        return view('admin.packages.index', compact('items'));
    }

    public function create()
    {
        if (!Gate::allows('access-admin')) {
            abort(403);
        }
        return view('admin.packages.create');
    }

    public function store(Request $request)
    {
        if (!Gate::allows('access-admin')) {
            abort(403);
        }

        // Handle features input as newline-separated string
        if ($request->has('features') && is_string($request->features)) {
            $features = array_filter(array_map('trim', explode("\n", $request->features)));
            $request->merge(['features' => array_values($features)]);
        }

        $data = $request->validate([
            'name' => ['required', 'string', 'max:120'],
            'price_text' => ['required', 'string', 'max:120'],
            'label' => ['nullable', 'string', 'max:80'],
            'features' => ['nullable', 'array'],
            'cta_link' => ['nullable', 'url'],
            'status' => ['required', 'in:active,inactive'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
        ]);
        $item = new Package($data);
        $item->save();
        return redirect()->route('admin.packages.index');
    }

    public function edit(Package $package)
    {
        if (!Gate::allows('access-admin')) {
            abort(403);
        }
        return view('admin.packages.edit', ['item' => $package]);
    }

    public function update(Request $request, Package $package)
    {
        if (!Gate::allows('access-admin')) {
            abort(403);
        }

        // Handle features input as newline-separated string
        if ($request->has('features') && is_string($request->features)) {
            $features = array_filter(array_map('trim', explode("\n", $request->features)));
            $request->merge(['features' => array_values($features)]);
        }

        $data = $request->validate([
            'name' => ['required', 'string', 'max:120'],
            'price_text' => ['required', 'string', 'max:120'],
            'label' => ['nullable', 'string', 'max:80'],
            'features' => ['nullable', 'array'],
            'cta_link' => ['nullable', 'url'],
            'status' => ['required', 'in:active,inactive'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
        ]);
        $package->fill($data)->save();
        return redirect()->route('admin.packages.index');
    }

    public function destroy(Package $package)
    {
        if (!Gate::allows('access-admin')) {
            abort(403);
        }
        $package->delete();
        return redirect()->route('admin.packages.index');
    }
}
