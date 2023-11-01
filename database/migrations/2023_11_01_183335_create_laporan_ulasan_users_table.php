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
        Schema::create('laporan_ulasan_users', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('ulasan_id');
            $table->text('laporan');
            $table->text('alasan');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('ulasan_id')->references('id')->on('ulasans');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('laporan_ulasan_users');
    }
};
