<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
use App\Models\Profile;
use App\Observers\ProfileObserver;

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
        }
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Profile::observe(ProfileObserver::class);

        Gate::define('access-admin', function ($user) {
            return $user->isAdmin();
        });

        Gate::define('manage-users', function ($user) {
            return $user->isSuperAdmin();
        });
    }
}
