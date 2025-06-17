<?php

namespace App\Providers;

use App\Models\Event;
use App\Models\User;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
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
        RateLimiter::for("login", function (Request $request) {
            return Limit::perMinute(6)->by($request->ip());
        });
        Gate::define("update-event", function (User $user, Event $event) {
            return $user->id === $event->user_id;
        });
    }
}
