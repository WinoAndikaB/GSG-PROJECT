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
        'nama_pelapor',
        'user_id_dilaporkan',
        'nama_dilaporkan',
        'artikel_id',
        'comment_id',
        'laporan',
        'alasan',
    ];

    // Define relationships
    public function pelapor()
    {
        return $this->belongsTo(User::class, 'user_id_pelapor');
    }

    public function dilaporkan()
    {
        return $this->belongsTo(User::class, 'user_id_dilaporkan');
    }

    public function artikel()
    {
        return $this->belongsTo(artikels::class, 'artikel_id');
    }
}
