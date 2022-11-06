<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    /**
     * Query the user that left this comment.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Query the post that this comment was left on.
     */
    public function post()
    {
        return $this->belongsTo(Post::class);
    }
}
