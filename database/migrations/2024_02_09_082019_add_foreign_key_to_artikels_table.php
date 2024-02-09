<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeyToArtikelsTable extends Migration
{
    public function up()
    {
        Schema::table('artikels', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    public function down()
    {
        Schema::table('artikels', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
        });
    }
}

