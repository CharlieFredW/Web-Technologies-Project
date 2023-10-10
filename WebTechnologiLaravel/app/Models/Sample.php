<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sample extends Model
{
    use HasFactory;

    protected $table = 'samples';

    protected $fillable = [
        'title',
        'description',
        'url',
        'owner',
        'bpm',
        'key',
        'genre',
        'instrument'
    ];

    public function ownerUserId()
    {
        return $this->belongsTo(User::class, 'owner');
    }
}
