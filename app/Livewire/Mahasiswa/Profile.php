<?php

namespace App\Livewire\Mahasiswa;

use Livewire\Component;
use App\Models\Mahasiswa;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;

#[Layout('mahasiswa.layout')]
class Profile extends Component
{
    public $nim;
    public $major;
    public $class;
    public $year;

    public function mount()
    {
        $mhs = Auth::user()->mahasiswa;

        $this->nim   = $mhs->nim;
        $this->major = $mhs->major;
        $this->class = $mhs->class;
        $this->year  = $mhs->year;
    }

    public function updateProfile()
    {
        $mhs = Auth::user()->mahasiswa;

        $mhs->update([
            'nim'   => $this->nim,
            'major' => $this->major,
            'class' => $this->class,
            'year'  => $this->year,
        ]);

        session()->flash('success', 'Profil berhasil diperbarui.');
    }

    public function render()
    {
        return view('livewire.mahasiswa.profile');
    }
}
