<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    use HasFactory;

    protected $fillable = [
        'kodeVideo', 'linkVideo', 'judulVideo', 'uploader', 'email', 'deskripsiVideo', 'statusVideo', 'kategoriVideo', 'tagsVideo'
    ];

    public function komentarVideo()
    {
        return $this->hasMany(komentar_video::class, 'video_id');
    }

    public function simpanVideos()
    {
        return $this->hasMany(SimpanVideo::class, 'video_id');
    }
}