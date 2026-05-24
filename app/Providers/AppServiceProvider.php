<?php

namespace App\Providers;

use App\Listeners\LogAuthActivity;
use Illuminate\Auth\Events\Login;
use Illuminate\Auth\Events\Logout;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\RateLimiter;
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
        Event::listen(Login::class,  [LogAuthActivity::class, 'handleLogin']);
        Event::listen(Logout::class, [LogAuthActivity::class, 'handleLogout']);

        // Rate limiter untuk form aspirasi publik:
        // maks 5 pengiriman per 10 menit per IP
        RateLimiter::for('aspirasi', function (Request $request) {
            return Limit::perMinutes(10, 5)->by($request->ip());
        });
    }
}
