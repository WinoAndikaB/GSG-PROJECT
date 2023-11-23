<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('laporan_komentar_artikels', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id_pelapor');
            $table->unsignedBigInteger('user_id_dilaporkan');
            $table->unsignedBigInteger('artikel_id');
            $table->unsignedBigInteger('comment_id');
            $table->text('laporan');
            $table->text('alasan');
            $table->timestamps();
    
            $table->foreign('user_id_pelapor')->references('id')->on('users');
            $table->foreign('user_id_dilaporkan')->references('id')->on('users');
            $table->foreign('artikel_id')->references('id')->on('artikels');
            $table->foreign('comment_id')->references('id')->on('komentar_artikels');
        });
    }
    


    public function down(): void
    {
        Schema::dropIfExists('laporan_komentar_artikels');
    }
};
