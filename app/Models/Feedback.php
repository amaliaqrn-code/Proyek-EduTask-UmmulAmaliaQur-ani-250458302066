<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Feedback extends Model
{
use HasFactory;


protected $table = 'feedback'; // explicit since table name is singular in your ERD


protected $fillable = ['submission_id', 'dosen_id', 'mahasiswa_id', 'comment', 'score'];


public function submission()
{
return $this->belongsTo(Submission::class);
}


public function dosen()
{
return $this->belongsTo(Dosen::class, 'dosen_id');
}


public function mahasiswa()
{
return $this->belongsTo(Mahasiswa::class, 'mahasiswa_id');
}
}
