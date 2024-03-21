<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LaporanKomentarVideo extends Model
{
    use HasFactory;

    protected $table = 'laporan_komentar_videos';

    protected $fillable = [
        'user_id_pelapor',
        'video_id',
        'comment_id',
        'laporan',
        'alasan',
        'freeze_until',
        'pesan_freeze',
        'freezeBy',
    ];

    // Define relationships
    public function pelapor()
    {
        return $this->belongsTo(user::class, 'user_id_pelapor');
    }

    public function video()
    {
        return $this->belongsTo(video::class, 'video_id');
    }

    public function komentarV()
    {
        return $this->belongsTo(komentar_video::class, 'comment_id');
    }
}
