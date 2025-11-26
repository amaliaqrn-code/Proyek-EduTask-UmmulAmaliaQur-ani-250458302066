<?php

namespace App\Livewire\Mahasiswa;

use Livewire\Component;
use App\Models\Notification;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;

#[Layout('mahasiswa.layout')]
class Notifications extends Component
{
    public function render() {

        // tandai semua notifikasi sebagai "read"
        Notification::where('user_id', Auth::id())->where('is_read', false)->update(['is_read' => true]);

        return view('livewire.mahasiswa.notifications', [
            'notifications' => Notification::where('user_id', Auth::id())->latest()->get(),
        ]);
    }
}

