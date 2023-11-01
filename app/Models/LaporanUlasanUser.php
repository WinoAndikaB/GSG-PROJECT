<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LaporanUlasanUser extends Model
{
    protected $table = 'laporan_ulasan_users';
    protected $fillable = ['user_id', 'laporan', 'alasan'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function ulasan()
    {
        return $this->belongsTo(ulasans::class, 'ulasan_id');
    }
}
