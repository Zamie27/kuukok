<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TechStack;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Gate;

class TechStackController extends Controller
{
    public function index()
    {
        if (!Gate::allows('access-admin')) {
            abort(403);
        }

        $techStacks = TechStack::orderBy('name')->get();
        return view('admin.tech_stacks.index', compact('techStacks'));
    }

    public function create()
    {
        if (!Gate::allows('access-admin')) {
            abort(403);
        }

        return view('admin.tech_stacks.create');
    }

    public function store(Request $request)
    {
        if (!Gate::allows('access-admin')) {
            abort(403);
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|string',
            'logo' => 'nullable|image|max:2048',
        ]);

        $data = $request->only(['name', 'category']);

        if ($request->hasFile('logo')) {
            $data['logo'] = $request->file('logo')->store('tech_stacks', 'public');
        }

        TechStack::create($data);

        return redirect()->route('admin.tech-stacks.index')->with('success', 'Tech Stack berhasil ditambahkan.');
    }

    public function edit(TechStack $techStack)
    {
        if (!Gate::allows('access-admin')) {
            abort(403);
        }

        return view('admin.tech_stacks.edit', compact('techStack'));
    }

    public function update(Request $request, TechStack $techStack)
    {
        if (!Gate::allows('access-admin')) {
            abort(403);
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|string',
            'logo' => 'nullable|image|max:2048',
        ]);

        $data = $request->only(['name', 'category']);

        if ($request->hasFile('logo')) {
            if ($techStack->logo && Storage::disk('public')->exists($techStack->logo)) {
                Storage::disk('public')->delete($techStack->logo);
            }
            $data['logo'] = $request->file('logo')->store('tech_stacks', 'public');
        }

        $techStack->update($data);

        return redirect()->route('admin.tech-stacks.index')->with('success', 'Tech Stack berhasil diperbarui.');
    }

    public function destroy(TechStack $techStack)
    {
        if (!Gate::allows('access-admin')) {
            abort(403);
        }

        if ($techStack->logo && Storage::disk('public')->exists($techStack->logo)) {
            Storage::disk('public')->delete($techStack->logo);
        }

        $techStack->delete();

        return redirect()->route('admin.tech-stacks.index')->with('success', 'Tech Stack berhasil dihapus.');
    }
}
