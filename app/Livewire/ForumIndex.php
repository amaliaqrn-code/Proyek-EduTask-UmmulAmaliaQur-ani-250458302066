<?php
namespace App\Livewire;

use Livewire\Component;
use App\Models\Forum;
use App\Models\Course;
use Livewire\Attributes\Layout;

#[Layout('mahasiswa.layout')]
class ForumIndex extends Component
{
    public $course;

    public function mount(Course $course)
    {
        $this->course = $course;
    }

    public function render()
    {
        $threads = Forum::where('course_id', $this->course->id)
            ->latest()
            ->get();

        return view('livewire.forum-index', compact('threads'));
    }
}
