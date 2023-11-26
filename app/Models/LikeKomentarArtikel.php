<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LikeKomentarArtikel extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'komentar_id',
        'artikel_id',
    ];

    public function artikel()
    {
        return $this->belongsTo(artikels::class);
    }
}
