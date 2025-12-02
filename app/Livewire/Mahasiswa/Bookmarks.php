<?php

namespace App\Livewire\Mahasiswa;

use Livewire\Component;
use App\Models\Bookmark;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;

#[Layout('mahasiswa.layout')]
class Bookmarks extends Component
{
    public $bookmarked = [];
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

    public function toggleBookmark($assignmentId) {
        $userId = Auth::id();
        $type = \App\Models\Assignment::class;

        $bookmark = Bookmark::where([
            'user_id' => $userId,
            'bookmarkable_id' => $assignmentId,
            'bookmarkable_type' => $type,
        ])->first();

        if ($bookmark) {
            $bookmark->delete();
            $this->bookmarked[$assignmentId] = false;
        } else {
            Bookmark::create([
                'user_id' => $userId,
                'bookmarkable_id' => $assignmentId,
                'bookmarkable_type' => $type,
            ]);
            $this->bookmarked[$assignmentId] = true;
        }
}
}
