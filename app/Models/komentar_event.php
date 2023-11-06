<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class komentar_event extends Model
{
    protected $fillable = [
        'pesan',
        'user_id',
        'event_id',
    ];

    // Relasi ke pengguna
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Relasi ke artikel
    public function event()
    {
        return $this->belongsTo(EventKomunitas::class, 'event_id');
    }
}
