<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TambahKolomFile extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('files', function($table){
            $table->enum('status', array('Aktif','Non-Aktif'));
            $table->enum('type', array('Video','Image'));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('files', function($table){
            $table->enum('status', array('Aktif','Non-Aktif'));
            $table->enum('type', array('Video','Image'));
        });
    }
}
