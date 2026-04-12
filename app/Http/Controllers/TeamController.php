<?php

namespace App\Http\Controllers;

use App\Models\Profile;

class TeamController extends Controller
{
    public function show(Profile $profile)
    {
        $profile->load(['user', 'techStacks', 'certifications', 'portfolios']);

        $techStacks = $profile->techStacks
            ? $profile->techStacks->sortBy('name')->groupBy('category')->sortKeys()
            : collect([]);

        return view('team.show', compact('profile', 'techStacks'));
    }
}
