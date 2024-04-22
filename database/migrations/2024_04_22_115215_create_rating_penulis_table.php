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
        Schema::create('rating_penulis', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('artikel_id');
            $table->unsignedBigInteger('user_id_penulis'); // Tambahkan kolom user_id_penulis
            $table->unsignedTinyInteger('rating');
            $table->timestamps();
        
            // Definisikan foreign key constraints jika diperlukan
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('artikel_id')->references('id')->on('artikels')->onDelete('cascade');
        });        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rating_penulis');
    }
};

