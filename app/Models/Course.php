<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Course extends Model
{
use HasFactory;

protected $fillable = ['code', 'name', 'description', 'dosen_id'];


public function dosen()
{
return $this->belongsTo(Dosen::class, 'dosen_id');
}


public function mahasiswas()
{
return $this->belongsToMany(Mahasiswa::class, 'course_students');
}


public function assignments()
{
return $this->hasMany(Assignment::class);
}


public function materials()
{
return $this->hasMany(Material::class);
}


public function forums()
{
return $this->hasMany(Forum::class);
}
}

