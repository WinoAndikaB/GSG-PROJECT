<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUserIdToArtikelsTable extends Migration
{
    public function up()
    {
        Schema::table('artikels', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id'); // Assuming user_id is an integer
            // You can add other constraints if needed
            // $table->foreign('user_id')->references('id')->on('users');
        });
    }

    public function down()
    {
        Schema::table('artikels', function (Blueprint $table) {
            $table->dropColumn('user_id');
        });
    }
}
