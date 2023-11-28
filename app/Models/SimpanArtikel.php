<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SimpanArtikel extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'artikel_id',
    ];

    public function artikel()
    {
        return $this->belongsTo(Artikels::class, 'artikel_id');
    }
    
}