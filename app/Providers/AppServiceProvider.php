<?php

namespace App\Providers;

use App\Models\Profile;
use App\Observers\ProfileObserver;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // Cek apakah folder public_html ada (indikasi struktur hosting cPanel/Shared Hosting)
        if (file_exists(base_path('../public_html'))) {
            $this->app->usePublicPath(realpath(base_path('../public_html')));
            // Pastikan storage path tetap di folder laravel untuk keamanan, tapi kita symlink ke public
        }
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Profile::observe(ProfileObserver::class);

        Gate::define('access-admin', function ($user) {
            return in_array($user->role, ['super_admin', 'admin', 'editor', 'penulis', 'user']);
        });

        Gate::define('manage-users', function ($user) {
            return $user->isSuperAdmin();
        });
    }
}
