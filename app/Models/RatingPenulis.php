<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RatingPenulis extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'user_id_penulis',
        'artikel_id',
        'video_id',
        'rating',
    ];

    // Definisi relasi dengan model User
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id_penulis');
    }
    

    // Definisi relasi dengan model Article
    public function artikel()
    {
        return $this->belongsTo(Artikels::class);
    }

     // Definisi relasi dengan model Article
    public function video()
    {
        return $this->belongsTo(video::class);
    }
}
