<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('like_komentar_videos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('komentar_id');
            $table->unsignedBigInteger('videos_id');
            $table->unsignedBigInteger('user_id');
            $table->timestamps();
    
            // Add foreign key constraints
            $table->foreign('komentar_id')->references('id')->on('komentar_videos');
            $table->foreign('videos_id')->references('id')->on('videos');
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('like_komentar_videos');
    }
};
