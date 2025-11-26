<?php

namespace App\Livewire\Partials;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\Notification;

class Navbar extends Component
{
    public function render()
    {
        $user = Auth::user();

        $unreadNotifications = 0;

        if ($user && $user->role === 'mahasiswa') {
            $unreadNotifications = Notification::where('user_id', $user->id)
                ->where('is_read', false)
                ->count();
        }

        return view('livewire.partials.navbar', [
            'unreadNotifications' => $unreadNotifications,
        ]);
    }
}
