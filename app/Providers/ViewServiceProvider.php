<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use App\Models\Notification;
use Illuminate\Support\Facades\Auth;

class ViewServiceProvider extends ServiceProvider
{
    public function boot()
    {
        View::composer('*', function ($view) {
            if (Auth::check() && Auth::user()->role === 'mahasiswa') {
                $unread = Notification::where('user_id', Auth::id())
                    ->where('is_read', false)
                    ->count();

                $view->with('unreadNotifications', $unread);
            } else {
                $view->with('unreadNotifications', 0);
            }
        });
    }
}
