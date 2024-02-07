<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LikeKomentarVideo extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'komentar_id',
        'videos_id',
    ];

    public function video()
    {
        return $this->belongsTo(video::class);
    }
}
