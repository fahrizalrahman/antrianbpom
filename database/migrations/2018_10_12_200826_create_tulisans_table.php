<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTulisansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tulisans', function (Blueprint $table) {
            $table->increments('id');
            $table->text('judul');
            $table->text('isi');
            $table->enum('float', array('footer','monitor'));
            $table->enum('lantai', array('1','2','3','4','5','6','monitor'));
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
        Schema::dropIfExists('tulisans');
    }
}
