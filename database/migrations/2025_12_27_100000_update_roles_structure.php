<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\User;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Set zamie.profile@gmail.com to super_admin
        $superAdminEmail = 'zamie.profile@gmail.com';
        $user = User::where('email', $superAdminEmail)->first();
        if ($user) {
            $user->role = 'super_admin';
            $user->save();
        } else {
            // Create if not exists (optional, but good for consistency)
            User::create([
                'name' => 'Zamie',
                'email' => $superAdminEmail,
                'password' => '$2y$12$Kj/wN.q.q.q.q.q.q.q.q.q.q.q.q.q.q.q.q.q.q.q.q', // Dummy hash or random
                'role' => 'super_admin',
            ]);
        }

        // Set all others to admin
        User::where('email', '!=', $superAdminEmail)->update(['role' => 'admin']);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Cannot easily reverse without knowing previous state
    }
};
