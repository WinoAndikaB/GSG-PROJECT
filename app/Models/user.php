<?php

// User.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'username',
        'name',
        'fotoProfil',
        'email',
        'password',
        'alamat',
        'instagram',
        'facebook',
        'aboutme',
        'role',
        'freeze_until',
        'pesan_freeze',
        'freezeBy',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    // Assuming you have a different model, replace 'KomentarArtikel' with your actual model name
    public function komentarArtikels()
    {
        return $this->hasMany(KomentarArtikel::class, 'user_id');
    }
}

