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
        Schema::table('laporan_video_users', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id_uploader')->after('user_id')->nullable();
            $table->foreign('user_id_uploader')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('laporan_video_users', function (Blueprint $table) {
            $table->dropForeign(['user_id_uploader']);
            $table->dropColumn('user_id_uploader');
        });
    }
};
