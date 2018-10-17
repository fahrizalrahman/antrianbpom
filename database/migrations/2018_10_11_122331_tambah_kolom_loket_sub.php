<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TambahKolomLoketSub extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::table('sublayanans', function($table) {
            $table->integer('batas_dari_jam')->nullable(); 
            $table->integer('batas_sampai_jam')->nullable(); 
            $table->integer('batas_antrian')->nullable(); 
            $table->string('kode_loket');
            $table->integer('petugas'); 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sublayanans', function($table) {
            $table->dropColumn('batas_dari_jam');
            $table->dropColumn('batas_sampai_jam'); 
            $table->dropColumn('batas_antrian'); 
            $table->dropColumn('kode_loket');
            $table->dropColumn('petugas');
        });
    }
}
