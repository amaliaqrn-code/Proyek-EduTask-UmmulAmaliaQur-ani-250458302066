<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Forum;
use App\Models\Course;
use Livewire\Attributes\Layout;

#[Layout('mahasiswa.layout')]
class ForumDetail extends Component
{
    public $course;
    public $thread;

    public function mount(Course $course, Forum $thread)
    {
        $this->course = $course;
        $this->thread = $thread;
    }

    public function render()
    {
        return view('livewire.forum-detail');
    }
}
