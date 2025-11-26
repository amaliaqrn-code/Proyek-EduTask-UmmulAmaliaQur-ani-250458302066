<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectRole
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check()) {
            $role = Auth::user()->role;

            return redirect(match ($role) {
                'admin'     => '/admin',
                'dosen'     => '/dosen/home',
                'mahasiswa' => '/mahasiswa/home',
                default     => '/',
            });
        }

        return $next($request);
    }
}
