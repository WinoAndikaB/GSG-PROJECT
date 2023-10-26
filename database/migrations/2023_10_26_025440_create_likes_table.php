<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLikesTable extends Migration
{
    public function up()
    {
        Schema::create('likes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('ulasan_id'); // Kolom untuk menghubungkan ke tabel "ulasans"
            $table->unsignedBigInteger('user_id'); // Kolom untuk menghubungkan ke tabel "users"
            $table->timestamps();

            $table->foreign('ulasan_id')->references('id')->on('ulasans')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('likes');
    }
}

