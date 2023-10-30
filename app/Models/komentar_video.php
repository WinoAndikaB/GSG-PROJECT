<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class komentar_video extends Model
{
    protected $fillable = [
        'pesan',
        'user_id',
        'artikel_id',
        // Tambahkan atribut lain sesuai dengan struktur tabel komentar
    ];

    // Relasi ke pengguna
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Relasi ke artikel
    public function video()
    {
        return $this->belongsTo(video::class, 'video_id');
    }
}
