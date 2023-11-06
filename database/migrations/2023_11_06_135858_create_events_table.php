<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->text('namaEvent');
            $table->text('pembuatEvent');
            $table->text('deskripsiEvent');
            $table->date('tanggalEvent');
            $table->time('jamEvent');
            $table->text('lokasiEvent');
            $table->text('informasiLebihLanjut');
            $table->text('status');
            $table->text('fotoEvent');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
