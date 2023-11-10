<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $table = 'events';
    protected $fillable = ['kodeEvent','pembuatEvent', 'namaEvent', 'deskripsiEvent', 'tanggalEvent', 'jamEvent', 'lokasiEvent', 'informasiLebihLanjut', 'status', 'fotoEvent'];

}
