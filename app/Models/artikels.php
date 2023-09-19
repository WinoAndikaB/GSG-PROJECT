<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class artikels extends Model
{
    use HasFactory;
    protected $fillable = [
        'id','gambar','judulArtikel','penulis', 'deskripsi'];
}
