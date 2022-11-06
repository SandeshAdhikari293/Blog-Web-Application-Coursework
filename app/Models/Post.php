<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    /**
     * Query the user that created this post.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Query the comments that have been left on this post.
     */
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
