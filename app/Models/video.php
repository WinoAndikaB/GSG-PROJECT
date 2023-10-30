<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class video extends Model
{
    use HasFactory;
    protected $fillable = [
        'id','linkVideo','judulVideo','uploader','email','deskripsiVideo','statusVideo','kategoriVideo','tagsVideo'];

    public function komentarVideo()
    {
        return $this->hasMany(komentar_video::class, 'video_id');
    }
}
