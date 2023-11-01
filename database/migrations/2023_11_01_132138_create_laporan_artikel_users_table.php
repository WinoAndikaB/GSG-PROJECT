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
        Schema::create('laporan_artikel_users', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('artikel_id');
            $table->text('laporan');
            $table->text('alasan');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('artikel_id')->references('id')->on('artikels');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('laporan_artikel_users');
    }
};
