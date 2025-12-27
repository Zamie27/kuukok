<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('profiles', function (Blueprint $table) {
            $table->string('slug')->nullable()->after('user_id');
        });

        // Populate slugs for existing profiles
        $profiles = DB::table('profiles')->get();
        foreach ($profiles as $profile) {
            $user = DB::table('users')->where('id', $profile->user_id)->first();
            if ($user) {
                $slug = Str::slug($user->name);
                // Ensure uniqueness
                $originalSlug = $slug;
                $count = 1;
                while (DB::table('profiles')->where('slug', $slug)->where('id', '!=', $profile->id)->exists()) {
                    $slug = $originalSlug . '-' . $count++;
                }
                
                DB::table('profiles')->where('id', $profile->id)->update(['slug' => $slug]);
            }
        }

        // Change to unique and not null
        Schema::table('profiles', function (Blueprint $table) {
            $table->string('slug')->nullable(false)->unique()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('profiles', function (Blueprint $table) {
            $table->dropColumn('slug');
        });
    }
};
