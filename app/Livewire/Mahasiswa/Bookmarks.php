<?php

namespace App\Livewire\Mahasiswa;

use Livewire\Component;
use App\Models\Bookmark;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;

#[Layout('mahasiswa.layout')]
class Bookmarks extends Component
{
    public function render()
    {
        $bookmarks = Bookmark::where('user_id', Auth::id())
            ->with('bookmarkable')
            ->latest()
            ->get();

        return view('livewire.mahasiswa.bookmarks', [
            'bookmarks' => $bookmarks
        ]);
    }
}
