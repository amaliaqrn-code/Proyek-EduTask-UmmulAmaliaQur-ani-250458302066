<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class Assignment extends Model {
use HasFactory;

protected $fillable = ['course_id', 'title', 'description', 'deadline', 'dosen_id'];
protected $casts = [
    'deadline' => 'datetime',
  ];

public function course() {
    return $this->belongsTo(Course::class);
}

public function dosen() {
    return $this->belongsTo(Dosen::class, 'dosen_id');
}


public function submissions() {
    return $this->hasMany(Submission::class);
}

public function submissionForMahasiswa($mahasiswaId) {
    return $this->submissions()->where('mahasiswa_id', $mahasiswaId)->first();
}

public function likes() {
    return $this->morphMany(Like::class, 'likeable');
}

public function bookmarks() {
    return $this->morphMany(Bookmark::class, 'bookmarkable');
}
}
