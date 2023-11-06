<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventKomunitas extends Model
{
    protected $table = 'event_komunitass';
    protected $fillable = ['id', 'pembuatEvent','namaEvent', 'deskripsiEvent','status', 'fotoEvent'];
}
