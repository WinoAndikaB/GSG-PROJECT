<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dislikes extends Model
{
    protected $table = 'dislikes';

    protected $fillable = [
        'ulasan_id', 'user_id',
    ];

    public function ulasan()
    {
        return $this->belongsTo(Ulasans::class, 'ulasan_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
