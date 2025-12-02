<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Material extends Model {
use HasFactory;


protected $fillable = ['course_id', 'title', 'file_url', 'dosen_id'];


public function course() {
    return $this->belongsTo(Course::class);
}


public function dosen() {
    return $this->belongsTo(Dosen::class, 'dosen_id');
}


// polymorphic relations
public function likes() {
    return $this->morphMany(like::class, 'likeable');
}


public function bookmarks() {
    return $this->morphMany(Bookmark::class, 'bookmarkable');
}
}
