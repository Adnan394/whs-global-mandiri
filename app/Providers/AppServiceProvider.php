<?php

namespace App\Providers;

use App\Models\UserLamaran;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Override public_path() biar upload ke folder public_html/sirakawgm
        if (!function_exists('public_path')) {
            function public_path($path = '')
            {
                return base_path('../public_html/sirakawgm') . ($path ? DIRECTORY_SEPARATOR . ltrim($path, '/') : '');
            }
        }
    }

}