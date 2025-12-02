<?php

namespace App\Filament\Pages;

use BackedEnum;
use Filament\Pages\Page;
use Filament\Support\Icons\Heroicon;
use Illuminate\Support\Facades\Auth;

class Logout extends Page
{
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedArrowLongLeft;
    protected static ?string $navigationLabel = 'Logout';

    public function mount()
    {
        Auth::logout();

        return redirect()->to('/');
    }
}
