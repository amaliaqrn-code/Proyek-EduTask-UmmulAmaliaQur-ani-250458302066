<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Forum extends Model
{
    protected $fillable = [
        'user_id',
        'course_id',
        'parent_id',
        'content',
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function course() {
        return $this->belongsTo(Course::class);
    }

    public function likes() {
        return $this->morphMany(\App\Models\Like::class, 'likeable');
    }

    public function bookmarks() {
        return $this->morphMany(\App\Models\Bookmark::class, 'bookmarkable');
    }

    public function parent() {
        return $this->belongsTo(Forum::class, 'parent_id');
    }

    public function replies() {
        return $this->hasMany(Forum::class, 'parent_id');
    }
}
