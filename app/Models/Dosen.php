<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Dosen extends Model
{
use HasFactory;


protected $table = 'dosens';


protected $fillable = ['user_id', 'nidn', 'department'];


public function user()
{
return $this->belongsTo(User::class);
}


public function courses()
{
return $this->hasMany(Course::class, 'dosen_id');
}


public function materials()
{
return $this->hasMany(Material::class);
}

public function assignments()
{
    return $this->hasMany(Assignment::class, 'dosen_id');
}



public function feedbacks()
{
return $this->hasMany(Feedback::class, 'dosen_id');
}
}
