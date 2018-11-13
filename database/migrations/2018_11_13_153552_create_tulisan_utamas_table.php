<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTulisanUtamasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tulisan_utamas', function (Blueprint $table) {
            $table->increments('id');
            $table->text('judul');
            $table->text('isi');
            $table->enum('float', array('utama'));
            $table->enum('lantai', array('1','4','5','6'));
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tulisan_utamas');
    }
}
