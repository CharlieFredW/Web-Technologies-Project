<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{

    //Blogs table in database
    protected $table = 'blogs';

    //Columns in database
    protected $fillable = ['title', 'content', 'user_id'];


    //The user relationship
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
