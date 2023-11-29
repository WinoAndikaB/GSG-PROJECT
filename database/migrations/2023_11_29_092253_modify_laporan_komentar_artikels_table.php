<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyLaporanKomentarArtikelsTable extends Migration
{
    public function up()
    {
        Schema::table('laporan_komentar_artikels', function (Blueprint $table) {
            // Drop the existing foreign key constraint
            $table->dropForeign('laporan_komentar_artikels_comment_id_foreign');

            // Add a new foreign key constraint with cascade delete
            $table->foreign('comment_id')
                  ->references('id')->on('komentar_artikels')
                  ->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::table('laporan_komentar_artikels', function (Blueprint $table) {
            // Drop the foreign key constraint in the down method
            $table->dropForeign('laporan_komentar_artikels_comment_id_foreign');
            
            // Recreate the foreign key without cascade delete if needed
            // $table->foreign('comment_id')
            //       ->references('id')->on('komentar_artikels');
        });
    }
}
