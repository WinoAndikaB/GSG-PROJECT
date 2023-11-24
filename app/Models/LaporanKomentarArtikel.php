<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LaporanKomentarArtikel extends Model
{
    use HasFactory;

    protected $table = 'laporan_komentar_artikels';

    protected $fillable = [
        'user_id_pelapor',
        'artikel_id',
        'comment_id',
        'laporan',
        'alasan',
        'freeze_until',
        'pesan_freeze',
    ];

    // Define relationships
    public function pelapor()
    {
        return $this->belongsTo(user::class, 'user_id_pelapor');
    }

    public function artikel()
    {
        return $this->belongsTo(artikels::class, 'artikel_id');
    }

    public function komentarA()
    {
        return $this->belongsTo(komentar_artikel::class, 'comment_id');
    }
}
