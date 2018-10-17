<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TambahKolomLoket extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::table('lokets', function($table) {
            $table->integer('batas_dari_jam')->nullable(); 
            $table->integer('batas_sampai_jam')->nullable(); 
            $table->integer('batas_antrian')->nullable(); 
            });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('lokets', function($table) {
            $table->dropColumn('batas_dari_jam');
            $table->dropColumn('batas_sampai_jam'); 
            $table->dropColumn('batas_antrian'); 
        });
    }
}
