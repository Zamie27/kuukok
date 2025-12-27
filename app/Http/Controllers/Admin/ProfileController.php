<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Profile;
use App\Models\TechStack;
use App\Models\Certification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Cache;

use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Str;

class ProfileController extends Controller
{
    public function edit()
    {
        if (!Gate::allows('access-admin')) {
            abort(403);
        }
        $profile = Profile::firstOrCreate(['user_id' => auth()->id()]);
        $profile->load(['techStacks', 'certifications']);

        $techStacks = TechStack::all()->groupBy('category');

        return view('admin.profiles.edit', compact('profile', 'techStacks'));
    }

    public function update(Request $request)
    {
        if (!Gate::allows('access-admin')) {
            abort(403);
        }

        // Validate Basic & Personal Info
        $rules = [
            'name' => ['required', 'string', 'max:255'],
            'position' => ['nullable', 'string', 'max:120'],
            'gender' => ['nullable', 'string', 'in:male,female'],
            'quote' => ['nullable', 'string', 'max:200'],
            'social_links' => ['nullable', 'array'],
            'social_links.*' => ['nullable', 'string'],

            'bio' => ['nullable', 'string'],
            'about_me' => ['nullable', 'string'],
            'address_city' => ['nullable', 'string'],
            'address_province' => ['nullable', 'string'],
            'address_country' => ['nullable', 'string'],
            'email' => ['required', 'email'],
            'joined_at' => ['nullable', 'date'],
            'specializations' => ['nullable', 'string'],
            'avatar' => ['nullable', 'image', 'mimes:jpeg,png,webp', 'max:2048'],

            'tech_stack_ids' => ['nullable', 'array'],
            'tech_stack_ids.*' => ['exists:tech_stacks,id'],

            'delete_cert_ids' => ['nullable', 'array'],
            'delete_cert_ids.*' => ['integer', 'exists:certifications,id'],

            'current_password' => ['nullable', 'required_with:new_password', 'current_password'],
            'new_password' => ['nullable', 'string', 'confirmed', Password::min(6)->mixedCase()->numbers()->symbols()],
        ];

        // Add rules for new certifications if present
        if ($request->has('certs_new')) {
            $rules['certs_new'] = ['array'];
            $rules['certs_new.*.name'] = ['required', 'string'];
            $rules['certs_new.*.issuer'] = ['required', 'string'];
            $rules['certs_new.*.year'] = ['required', 'integer'];
            $rules['certs_new.*.file'] = ['nullable', 'file', 'mimes:pdf,jpg,jpeg,png', 'max:2048'];
        }

        $data = $request->validate($rules);

        $profile = Profile::firstOrCreate(['user_id' => auth()->id()]);

        // Update User Name/Email if changed
        $user = auth()->user();
        if ($user->name !== $request->name || $user->email !== $request->email) {
            // Update slug if name changes
            if ($user->name !== $request->name) {
                $slug = Str::slug($request->name);
                $originalSlug = $slug;
                $count = 1;
                while (Profile::where('slug', $slug)->where('id', '!=', $profile->id)->exists()) {
                    $slug = $originalSlug . '-' . $count++;
                }
                $profile->slug = $slug;
            }

            $user->name = $request->name;
            $user->email = $request->email;
            $user->save();
        }

        // Handle Password Update
        if ($request->filled('new_password')) {
            $user->forceFill([
                'password' => Hash::make($request->new_password),
            ])->save();
        }

        // Handle Specializations
        if ($request->filled('specializations')) {
            $data['specializations'] = array_map('trim', explode(',', $request->specializations));
        } else {
            $data['specializations'] = [];
        }

        // Fill Profile Data (exclude special fields)
        $profileData = collect($data)->except([
            'avatar',
            'tech_stack_ids',
            'certs_new',
            'delete_cert_ids',
            'name',
            'email',
            'current_password',
            'new_password',
            'new_password_confirmation'
        ])->toArray();

        $profile->fill($profileData);

        // Handle Avatar
        if ($request->hasFile('avatar')) {
            if ($profile->avatar && Storage::disk('public')->exists($profile->avatar)) {
                Storage::disk('public')->delete($profile->avatar);
            }
            $profile->avatar = $request->file('avatar')->store('profiles/' . auth()->id(), 'public');
        }

        $profile->save();

        // Sync Tech Stacks
        if ($request->has('tech_stack_ids')) {
            $profile->techStacks()->sync($request->tech_stack_ids);
        } else {
            $profile->techStacks()->detach();
        }

        // Handle Certifications
        // 1. Delete requested certs
        if ($request->filled('delete_cert_ids')) {
            $certsToDelete = $profile->certifications()->whereIn('id', $request->delete_cert_ids)->get();
            foreach ($certsToDelete as $cert) {
                if ($cert->file_path && Storage::disk('public')->exists($cert->file_path)) {
                    Storage::disk('public')->delete($cert->file_path);
                }
                $cert->delete();
            }
        }

        // 2. Add new certs
        if ($request->has('certs_new')) {
            foreach ($request->certs_new as $certData) {
                if (empty($certData['name'])) continue;

                $path = null;
                if (isset($certData['file']) && $certData['file'] instanceof \Illuminate\Http\UploadedFile) {
                    $path = $certData['file']->store('certifications/' . auth()->id(), 'public');
                }

                $profile->certifications()->create([
                    'name' => $certData['name'],
                    'issuer' => $certData['issuer'],
                    'year' => $certData['year'],
                    'credential_id' => $certData['credential_id'] ?? null,
                    'file_path' => $path,
                ]);
            }
        }

        // Clear public profile cache
        Cache::forget('team_profile_detail');

        if ($request->wantsJson()) {
            return response()->json([
                'message' => 'Profile updated successfully.',
                'profile' => $profile->load(['techStacks', 'certifications']),
            ]);
        }

        return redirect()->route('admin.profile.edit')->with('success', 'Profile updated successfully.');
    }

    public function deleteAvatar()
    {
        if (!Gate::allows('access-admin')) {
            abort(403);
        }

        $profile = Profile::where('user_id', auth()->id())->first();

        if ($profile && $profile->avatar) {
            if (Storage::disk('public')->exists($profile->avatar)) {
                Storage::disk('public')->delete($profile->avatar);
            }

            $profile->avatar = null;
            $profile->save();

            Cache::forget('team_profile_detail');

            return back()->with('success', 'Foto profil berhasil dihapus.');
        }

        return back()->with('error', 'Tidak ada foto profil yang dapat dihapus.');
    }
}
