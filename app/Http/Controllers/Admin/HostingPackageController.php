<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HostingPackage;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class HostingPackageController extends Controller
{
    public function index()
    {
        if (! Gate::allows('access-admin')) {
            abort(403);
        }
        $items = HostingPackage::orderBy('sort_order')->get();
        // Mimic settings from PackageController but for 'hosting' group
        $settings = Setting::where('group', 'hosting')->pluck('value', 'key');

        return view('admin.hosting_packages.index', compact('items', 'settings'));
    }

    public function create()
    {
        if (! Gate::allows('access-admin')) {
            abort(403);
        }

        return view('admin.hosting_packages.create');
    }

    public function store(Request $request)
    {
        if (! Gate::allows('access-admin')) {
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
        HostingPackage::create($data);

        return redirect()->route('admin.hosting-packages.index')->with('success', 'Paket hosting berhasil ditambahkan.');
    }

    public function edit(HostingPackage $hostingPackage)
    {
        if (! Gate::allows('access-admin')) {
            abort(403);
        }

        return view('admin.hosting_packages.edit', ['item' => $hostingPackage]);
    }

    public function update(Request $request, HostingPackage $hostingPackage)
    {
        if (! Gate::allows('access-admin')) {
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
        $hostingPackage->update($data);

        return redirect()->route('admin.hosting-packages.index')->with('success', 'Paket hosting berhasil diperbarui.');
    }

    public function destroy(HostingPackage $hostingPackage)
    {
        if (! Gate::allows('access-admin')) {
            abort(403);
        }
        $hostingPackage->delete();

        return redirect()->route('admin.hosting-packages.index')->with('success', 'Paket hosting berhasil dihapus.');
    }

    /**
     * Update settings specifically for hosting page
     */
    public function updateSettings(Request $request)
    {
        if (! Gate::allows('access-admin')) {
            abort(403);
        }

        $data = $request->validate([
            'hosting_pros_items' => ['nullable', 'string'],
            'hosting_cons_items' => ['nullable', 'string'],
            'hosting_description' => ['nullable', 'string'],
        ]);

        foreach ($data as $key => $value) {
            Setting::updateOrCreate(
                ['key' => $key],
                ['value' => $value, 'group' => 'hosting']
            );
        }

        return redirect()->back()->with('success', 'Pengaturan hosting berhasil diperbarui.');
    }
}
