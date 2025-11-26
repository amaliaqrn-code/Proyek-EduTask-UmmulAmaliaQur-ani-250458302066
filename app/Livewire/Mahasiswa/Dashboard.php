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
    public function render()
    {
        $mahasiswa = Auth::user()->mahasiswa;

        // Ambil semua assignment milik mahasiswa
        $assignments = Assignment::whereIn('course_id', $mahasiswa->courses->pluck('id'))->get();

        // Ambil semua submission mahasiswa
        $submissions = Submission::where('mahasiswa_id', $mahasiswa->id)->get();

        // List ID assignment yang sudah dikerjakan
        $submittedIds = $submissions->pluck('assignment_id')->toArray();

        // Hitung tugas selesai dan belum
        $tugasSudah = $assignments->whereIn('id', $submittedIds)->count();
        $tugasBelum = $assignments->whereNotIn('id', $submittedIds)->count();

        // Hitung persentase progress
        $totalTugas = $assignments->count();
        $persentase = $totalTugas > 0 ? round(($tugasSudah / $totalTugas) * 100) : 0;

        // Ambil 3 tugas terdekat deadline
        $tugasTerdekat = $assignments->sortBy('deadline')->take(3);

        // Point Aktivitas Mahasiswa
        $totalPoints = Submission::where('mahasiswa_id', $mahasiswa->id)->sum('points_awarded');


        return view('livewire.mahasiswa.dashboard', [
            'tugasSudah'       => $tugasSudah,
            'tugasBelum'       => $tugasBelum,
            'totalTugas'       => $totalTugas,
            'persentase'       => $persentase,
            'tugasTerdekat'    => $tugasTerdekat,
            'totalPoints'      => $totalPoints,
        ]);
    }
}
