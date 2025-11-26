<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CourseStudent extends Model
{
    protected $table = 'course_students';

    protected $fillable = [
        'course_id',
        'mahasiswa_id',
    ];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class);
    }
}
