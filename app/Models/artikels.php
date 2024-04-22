<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class artikels extends Model
{
    use HasFactory;
    
    protected $fillable = ['kodeArtikel', 'user_id', 'artikel_id', 'gambarArtikel', 'judulArtikel', 'penulis', 'email', 'deskripsi', 'status', 'kategori', 'tags', 'jumlah_akses'];


    // Define the relationship with the User model
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }   

    public function komentarArtikel()
    {
        return $this->hasMany(komentar_artikel::class, 'artikel_id');
    }   

    public function simpanArtikels()
    {
        return $this->hasMany(SimpanArtikel::class, 'artikel_id');
    }

    public function ratings()
{
    return $this->hasMany(RatingPenulis::class);
}
}
