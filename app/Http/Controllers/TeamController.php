<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class TeamController extends Controller
{
    public function show(Profile $profile)
    {
        $profile->load(['user', 'techStacks', 'certifications']);

        $techStacks = $profile->techStacks
            ? $profile->techStacks->sortBy('name')->groupBy('category')->sortKeys()
            : collect([]);

        return view('team.show', compact('profile', 'techStacks'));
    }
}
