<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LaporanVideoUser extends Model
{
    protected $table = 'laporan_video_users';
    protected $fillable = ['user_id', 'video_id', 'laporan', 'alasan','tindakan','user_id_uploader'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function video()
    {
        return $this->belongsTo(Video::class, 'video_id');
    }

    public function uploader()
    {
        return $this->belongsTo(User::class, 'user_id_uploader', 'id');
    }
}
