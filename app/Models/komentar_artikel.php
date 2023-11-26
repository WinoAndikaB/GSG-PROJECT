<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class komentar_artikel extends Model
{
    protected $fillable = [
        'pesan',
        'user_id',
        'artikel_id',
    ];

    // Relasi ke pengguna
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Relasi ke artikel
    public function artikel()
    {
        return $this->belongsTo(Artikels::class, 'artikel_id');
    }

    public function likes()
    {
        return $this->hasMany(LikeKomentarArtikel::class, 'komentar_id');
    }
}
