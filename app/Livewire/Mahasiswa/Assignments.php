<?php
namespace App\Livewire\Mahasiswa;

use Livewire\Component;
use App\Models\Assignment;
use App\Models\Bookmark;
use App\Models\Submission;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;

#[Layout('mahasiswa.layout')]
class Assignments extends Component
{
    public $bookmarked = [];
    public $sortDeadline = 'asc';

    public function render()
    {
        $mahasiswa = Auth::user()->mahasiswa;

        $assignments = Assignment::whereIn('course_id', $mahasiswa->courses->pluck('id'))
        ->orderBy('deadline', $this->sortDeadline)
        ->get();

        if ($this->sortDeadline === 'today') {
            $assignments = $assignments->whereBetween('deadline', [now()->startOfDay(), now()->endOfDay()]);
        }

        if ($this->sortDeadline === 'week') {
            $assignments = $assignments->whereBetween('deadline', [now()->startOfWeek(), now()->endOfWeek()]);
        }

        if ($this->sortDeadline === 'month') {
            $assignments = $assignments->whereBetween('deadline', [now()->startOfMonth(), now()->endOfMonth()]);
        }


        $assignments = Assignment::whereIn('course_id', $mahasiswa->courses->pluck('id'))
            ->orderBy('deadline', 'asc')
            ->get();

        $submissions = Submission::where('mahasiswa_id', Auth::user()->mahasiswa->id)
            ->get()
            ->keyBy('assignment_id');

        return view('livewire.mahasiswa.assignments', [
            'assignments' => $assignments,
            'submissions' => $submissions,
        ]);
    }

    public function mount()
    {
        $userId = Auth::id();
        $type = \App\Models\Assignment::class;

        // Ambil semua bookmark user untuk assignment
        $bookmarks = Bookmark::where('user_id', $userId)
            ->where('bookmarkable_type', $type)
            ->pluck('bookmarkable_id')
            ->toArray();

        // Masukkan ke array
        foreach ($bookmarks as $assignmentId) {
            $this->bookmarked[$assignmentId] = true;
        }
    }

    public function toggleBookmark($assignmentId)
    {
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
