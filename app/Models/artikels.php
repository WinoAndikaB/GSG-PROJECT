<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class artikels extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'id','kodeArtikel', 'user_id', 'artikel_id', 'gambarArtikel', 'judulArtikel', 'penulis', 'email', 'deskripsi', 'status', 'kategori', 'tags'
    ];

    public function komentarArtikel()
    {
        return $this->hasMany(komentar_artikel::class, 'artikel_id');
    }   

    public function simpanArtikels()
    {
        return $this->hasMany(SimpanArtikel::class);
    }
}
