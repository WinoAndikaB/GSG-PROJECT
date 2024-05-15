<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LaporanArtikelUser extends Model
{
    protected $table = 'laporan_artikel_users';
    protected $fillable = ['user_id', 'artikel_id', 'laporan', 'alasan', 'tindakan','user_id_penulis'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function artikel()
    {
        return $this->belongsTo(artikels::class, 'artikel_id', 'id');
    }

    public function penulis()
    {
        return $this->belongsTo(User::class, 'user_id_penulis', 'id');
    }
}
