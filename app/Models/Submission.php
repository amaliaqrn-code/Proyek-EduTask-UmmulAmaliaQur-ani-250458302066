<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Submission extends Model
{
use HasFactory;


protected $fillable = [
    'assignment_id',
    'mahasiswa_id',
    'file_url',
    'status',
    'points_awarded',
    'points_reason'
];


protected $casts = [
'submitted_at' => 'datetime',
];


public function assignment()
{
return $this->belongsTo(Assignment::class);
}


public function mahasiswa()
{
return $this->belongsTo(Mahasiswa::class);
}


public function feedbacks()
{
return $this->hasMany(Feedback::class);
}


public function activityPoints()
{
return $this->hasMany(ActivityPoint::class);
}
}
