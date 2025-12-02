<?php

namespace App\Livewire\Mahasiswa;

use App\Models\Course;
use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\WithPagination;

#[Layout('mahasiswa.layout')]
class CourseSelector extends Component {
    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    protected $queryString = ['page'];

    public function addCourse($courseId)
    {
        // ambil mahasiswa_id dari user
        $mahasiswaId = Auth::user()->mahasiswa->id;

        // Cek udah terdaftar pa belom
        $exists = DB::table('course_students')
            ->where('course_id', $courseId)
            ->where('mahasiswa_id', $mahasiswaId)
            ->exists();

        if ($exists) {
            session()->flash('error', 'Anda sudah mengambil mata kuliah ini.');
            return;
        }

        // simpan kalo belum ada
        DB::table('course_students')->insert([
            'course_id' => $courseId,
            'mahasiswa_id' => $mahasiswaId,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        session()->flash('success', 'Mata kuliah berhasil ditambahkan.');
    }

    public function render()
    {
        $mahasiswa = Auth::user()->mahasiswa;

        $availableCourses = Course::whereNotIn('id', function($query) use ($mahasiswa) {
            $query->select('course_id')
                  ->from('course_students')
                  ->where('mahasiswa_id', $mahasiswa->id);
        })->paginate(6);

        return view('livewire.mahasiswa.course-selector', [
            'availableCourses' => $availableCourses
        ]);
    }
}
