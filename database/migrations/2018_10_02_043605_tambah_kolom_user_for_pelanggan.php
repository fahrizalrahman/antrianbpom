<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TambahKolomUserForPelanggan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
         Schema::table('users', function($table) {
            $table->string('nik')->nullable(); 
            $table->string('alamat')->nullable(); 
            $table->string('no_telp')->nullable(); 
            $table->string('foto')->nullable(); 
            });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::table('users', function($table) {
            $table->dropColumn('nik'); 
            $table->dropColumn('alamat'); 
            $table->dropColumn('no_telp'); 
            $table->dropColumn('foto'); 
        });
    }
}
