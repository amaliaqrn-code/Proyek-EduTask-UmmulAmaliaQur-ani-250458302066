<?php
namespace App\Livewire\Mahasiswa;

use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('mahasiswa.layout')]
class Mycourse extends Component
{
    public $courses;

    public function mount()
    {
        $this->courses = Auth::user()->mahasiswa->courses ?? collect();
    }

    public function showCourse($id)
    {
        return redirect()->route('mahasiswa.courses.show', $id);
    }

    public function render()
    {
        return view('livewire.mahasiswa.mycourse');
    }
}
