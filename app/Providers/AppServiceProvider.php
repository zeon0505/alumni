<?php

namespace App\Providers;

use App\Auth\AlumniUserProvider;
use App\Models\Alumni;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        Auth::provider('alumni-eloquent', function ($app, array $config) {
            return new AlumniUserProvider($app['hash'], Alumni::class);
        });
    }
}
