<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Forum;
use App\Models\Course;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;

#[Layout('mahasiswa.layout')]
class ForumCreate extends Component
{
    public $course;
    public $title;
    public $content;

    public function mount(Course $course)
    {
        $this->course = $course;
    }

    public function submit()
    {
        $this->validate([
            'title' => 'required|min:3',
            'content' => 'required|min:10',
        ]);

        Forum::create([
            'course_id' => $this->course->id,
            'user_id'   => Auth::id(),
            'title'     => $this->title,
            'content'   => $this->content,
        ]);

        return redirect()->route('mahasiswa.forum.index', $this->course->id);
    }

    public function render()
    {
        return view('livewire.forum-create');
    }
}
