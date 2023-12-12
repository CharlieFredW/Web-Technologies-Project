<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;


class Comment extends Model
{
    protected $fillable = ['comment'];


    //Foreign key to blog_id in the database
    public function blog()
    {
        return $this->belongsTo(Blog::class, 'blog_id');
    }

    //Foreign key for user_id in the database
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    //Is user the owner
    public function isOwner()
    {
        return Auth::check() && Auth::id() === $this->user_id;
    }
}


