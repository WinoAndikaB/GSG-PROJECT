<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUserIdPenulisToLaporanArtikelUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('laporan_artikel_users', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id_penulis')->after('user_id')->nullable();
            $table->foreign('user_id_penulis')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('laporan_artikel_users', function (Blueprint $table) {
            $table->dropForeign(['user_id_penulis']);
            $table->dropColumn('user_id_penulis');
        });
    }
}
