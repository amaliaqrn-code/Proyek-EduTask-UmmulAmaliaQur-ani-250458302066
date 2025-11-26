<?php
namespace App\Livewire\Mahasiswa;

use Livewire\Component;
use App\Models\Course;
use Livewire\Attributes\Layout;

#[Layout('mahasiswa.layout')]
class CourseDetail extends Component
{
    public $course;

    public function mount(Course $course)
    {
        $this->course = $course->load(['dosen.user', 'materials', 'assignments']);
    }

    public function render()
    {
        return view('livewire.mahasiswa.course-detail');
    }
}
