<?php

namespace App\Filament\Admin\Pages\Auth;

use Filament\Pages\Auth\Login as BaseLogin;
use Illuminate\Support\Facades\Auth;

class Login extends BaseLogin
{
    public function getRedirectUrl(): string
    {
        $role = Auth::user()->role;

        return match ($role) {
            'admin' => '/admin/dashboard',
            'dosen' => '/dosen/dosen-page',
            'mahasiswa' => '/mahasiswa/mahasiswa-page',
            default => '/',
        };
    }
}
