<?php

namespace App\Models;

//Comment to test git
// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;


    public function image()
    {
        return $this->morphOne(Image::class, 'imageable');
    }

    public function latestImage()
    {
        return $this->morphOne(Image::class, 'imageable')->latestOfMany();
    }

    public function profile()
    {
        return $this->hasOne(Profile::class);
    }

    public function upvotes(){
        return $this->belongsToMany(Post::class);
    }

    /**
     * Query the comments that the user has sent.
     */
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    /**
     * Query the posts that the user has uploaded.
     */
    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
