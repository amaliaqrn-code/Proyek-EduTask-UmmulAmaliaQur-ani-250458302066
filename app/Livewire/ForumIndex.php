<?php
namespace App\Livewire;

use Livewire\Component;
use App\Models\Forum;
use App\Models\Course;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;

#[Layout('mahasiswa.layout')]
class ForumIndex extends Component
{
    public $course;

    public $liked = [];
    public $bookmarked = [];

    public function mount(Course $course)
    {
        $this->course = $course;

        $this->liked = Forum::where('course_id', $course->id)
            ->whereHas('likes', fn($q) => $q->where('user_id', Auth::id()))
            ->pluck('id')
            ->toArray();

        $this->bookmarked = Forum::where('course_id', $course->id)
            ->whereHas('bookmarks', fn($q) => $q->where('user_id', Auth::id()))
            ->pluck('id')
            ->toArray();
    }

    public function toggleLike($id)
    {
        $forum = Forum::find($id);

        $exist = $forum->likes()->where('user_id', Auth::id())->first();

        if ($exist) {
            $exist->delete();
            $this->liked = array_diff($this->liked, [$id]);
        } else {
            $forum->likes()->create(['user_id' => Auth::id()]);
            $this->liked[] = $id;
        }
    }

    public function toggleBookmark($id)
    {
        $forum = Forum::find($id);

        $exist = $forum->bookmarks()->where('user_id', Auth::id())->first();

        if ($exist) {
            $exist->delete();
            $this->bookmarked = array_diff($this->bookmarked, [$id]);
        } else {
            $forum->bookmarks()->create(['user_id' => Auth::id()]);
            $this->bookmarked[] = $id;
        }
    }

    public function render()
    {
        $threads = Forum::where('course_id', $this->course->id)
            ->latest()
            ->get();

        return view('livewire.forum-index', compact('threads'));
    }
}
