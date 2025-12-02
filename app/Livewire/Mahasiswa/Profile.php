<?php

namespace App\Livewire\Mahasiswa;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Mahasiswa;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;

#[Layout('mahasiswa.layout')]
class Profile extends Component
{
    use WithFileUploads;

    public $nim;
    public $major;
    public $class;
    public $year;
    public $photo;
    public $oldPhoto;

    public function mount()
{
    $mhs = Auth::user()->mahasiswa;

    // Jika belum punya data mahasiswa → buat dulu
    if (!$mhs) {
        $mhs = Mahasiswa::create([
            'user_id' => Auth::id(),
            'photo' => null,
            'nim' => null,
            'major' => null,
            'class' => null,
            'year' => null,
            'total_points' => 0,
        ]);
    }

    // Setelah pasti ada, isi form
    $this->nim      = $mhs->nim;
    $this->major    = $mhs->major;
    $this->class    = $mhs->class;
    $this->year     = $mhs->year;
    $this->oldPhoto = $mhs->photo;
}


    public function updateProfile()
    {
         $this->validate([
            'nim'   => 'required',
            'major' => 'required',
            'class' => 'required',
            'year'  => 'required|numeric',
            'photo' => 'nullable|image|max:1024',
        ]);

        $mhs = Auth::user()->mahasiswa;

        if (!$mhs) {
            return redirect()->route('mahasiswa.profile.create');
        }

        // simpan file kalau ada upload baru
        if ($this->photo) {
            $fileName = $this->photo->store('photos', 'public');
        } else {
            $fileName = $this->oldPhoto; // tetap gunakan foto lama
        }

        $mhs->update([
            'nim'   => $this->nim,
            'major' => $this->major,
            'class' => $this->class,
            'year'  => $this->year,
            'photo' => $fileName,
        ]);

        session()->flash('success', 'Profil berhasil diperbarui.');
    }

    public function render()
    {
        return view('livewire.mahasiswa.profile');
    }
}
