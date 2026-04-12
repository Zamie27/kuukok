<?php

namespace App\Actions\Fortify;

use App\Models\Profile;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Laravel\Fortify\Contracts\CreatesNewUsers;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array<string, string>  $input
     */
    public function create(array $input): User
    {
        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique(User::class),
            ],
            'password' => $this->passwordRules(),
        ])->validate();

        $otp = rand(100000, 999999);
        $user = User::create([
            'name' => $input['name'],
            'email' => $input['email'],
            'password' => $input['password'],
            'role' => 'user',
            'otp_code' => $otp,
            'otp_expires_at' => now()->addMinutes(10),
            'is_active' => false,
        ]);

        // Send OTP Notification
        $user->notify(new \App\Notifications\VerifyEmailOtp($otp, $user->name));

        // Create empty profile with auto-generated slug
        Profile::create([
            'user_id' => $user->id,
        ]);

        return $user;
    }
}
