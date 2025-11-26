<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Mahasiswa extends Model
{
use HasFactory;


/**
* Explicit table name to match your existing migration: 'mahasiswas'
*/
protected $table = 'mahasiswas';


protected $fillable = ['user_id', 'nim', 'major', 'class', 'year', 'total_points'];


public function user()
{
return $this->belongsTo(User::class);
}


public function courses()
{
return $this->belongsToMany(Course::class, 'course_students');
}


public function submissions()
{
return $this->hasMany(Submission::class);
}


public function activityPoints()
    {
        return $this->hasMany(ActivityPoint::class);
    }

public function getTotalPointsAttribute()
    {
        return $this->activityPoints()->sum('points');
    }

public function feedbacks()
    {
        return $this->hasMany(Feedback::class, 'mahasiswa_id');
    }
}
