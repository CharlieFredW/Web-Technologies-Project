<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    use HasFactory;

    protected $table = 'ratings';

    protected $fillable = [
        'sample_id',
        'user_id',
        'rating'

    ];

    public function sample()
    {
        return $this->belongsTo(\App\Models\Sample::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function ratings()
    {
        return $this->hasMany(\App\Models\Rating::class);
    }
}
