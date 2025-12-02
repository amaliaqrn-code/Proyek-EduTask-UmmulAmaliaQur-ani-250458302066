<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class ActivityPoint extends Model {

    use HasFactory;

    protected $fillable = [
        'mahasiswa_id',
        'submission_id',
        'points',
        'badge'
    ];


public function mahasiswa() {
    return $this->belongsTo(Mahasiswa::class);
    }

public function submission() {
    return $this->belongsTo(Submission::class);
    }
}
