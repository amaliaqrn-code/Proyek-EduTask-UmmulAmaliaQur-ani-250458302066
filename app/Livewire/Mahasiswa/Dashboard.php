<?php

namespace App\Livewire\Mahasiswa;

use Livewire\Component;
use App\Models\Assignment;
use App\Models\Submission;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;

#[Layout('mahasiswa.layout')]
class Dashboard extends Component
{
    public $tugasSudah;
    public $tugasBelum;
    public $totalTugas;
    public $persentase;
    public $tugasTerdekat;
    public $totalPoints;

    public function render()
    {
        $mahasiswa = Auth::user()->mahasiswa;

        if (!$mahasiswa) {
            $this->tugasSudah = 0;
            $this->tugasBelum = 0;
            $this->totalTugas = 0;
            $this->persentase = 0;
            $this->tugasTerdekat = [];
            $this->totalPoints = 0;

            return view('livewire.mahasiswa.dashboard');
        }

        $assignments = Assignment::whereIn(
            'course_id',
            $mahasiswa->courses->pluck('id')
        )->get();

        // Submission milik mahasiswa
        $submissions = Submission::where('mahasiswa_id', $mahasiswa->id)->get();

        $submittedIds = $submissions->pluck('assignment_id')->toArray();

        $this->tugasSudah  = $assignments->whereIn('id', $submittedIds)->count();
        $this->tugasBelum  = $assignments->whereNotIn('id', $submittedIds)->count();
        $this->totalTugas  = $assignments->count();
        $this->persentase  = $this->totalTugas > 0
            ? round(($this->tugasSudah / $this->totalTugas) * 100)
            : 0;

        $this->tugasTerdekat = $assignments->sortBy('deadline')->take(3);

        $this->totalPoints = Submission::where('mahasiswa_id', $mahasiswa->id)
            ->sum('points_awarded');

        return view('livewire.mahasiswa.dashboard');
    }
}
