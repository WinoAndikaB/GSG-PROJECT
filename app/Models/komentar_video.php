<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class komentar_video extends Model
{
    protected $fillable = [
        'pesan',
        'user_id',
        'video_id', // Corrected attribute name
    ];

    // Relasi ke pengguna
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Relasi ke video (assuming 'video' is the correct model name)
    public function video()
    {
        return $this->belongsTo(Video::class, 'video_id');
    }

    public function likes()
    {
        return $this->hasMany(LikeKomentarVideo::class, 'komentar_id');
    }
}

