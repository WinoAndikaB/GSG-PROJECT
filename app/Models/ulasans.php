<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ulasans extends Model
{
    use HasFactory;
    protected $fillable = [
        'id','email','nama','pesan','rating','fotoProfil'];

        public function likes()
        {
            return $this->hasMany(Likes::class, 'ulasan_id');
        }

        public function dislikes()
        {
            return $this->hasMany(Dislikes::class, 'ulasan_id');
        }

}
