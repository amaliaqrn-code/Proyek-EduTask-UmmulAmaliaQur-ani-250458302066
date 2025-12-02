<?php

namespace App\Imports;

use App\Models\Mahasiswa;
use App\Models\Student;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class StudentCourseImport implements ToCollection, WithHeadingRow
{
    protected $course;

    public function __construct($course)
    {
        $this->course = $course;
    }

    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {

            if (! isset($row['nim'])) {
                continue;
            }

            $student = Mahasiswa::where('nim', $row['nim'])->first();

            if (! $student) {
                continue;
            }

            $this->course
                ->mahasiswas()
                ->syncWithoutDetaching([$student->id]);
        }
    }
}
