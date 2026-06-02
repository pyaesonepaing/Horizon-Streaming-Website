<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\File;

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
    public function boot()
{
    if (app()->environment('production')) {
        URL::forceScheme('https');
    }
    if (!File::exists(storage_path('logs'))) {
        File::makeDirectory(storage_path('logs'), 0755, true);
    }
}

}
