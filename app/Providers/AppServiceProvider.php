<?php

namespace App\Providers;

use App\Models\Notification;
use Filament\Schemas\Components\Livewire;
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
    View::composer('*', function ($view) {
        if (Auth::check()) {
            $count = Notification::where('user_id', Auth::id())
                ->where('is_read', false)
                ->count();

            $view->with('unreadNotifications', $count);
        }
    });
}
}
