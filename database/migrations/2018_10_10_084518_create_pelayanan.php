<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePelayanan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pelayanans', function (Blueprint $table) {
            $table->integer('rowid');
            $table->integer('id_antrian');
            $table->integer('no_antrian');
            $table->integer('id_petugas');
            $table->string('keterangan', 128)->default('-');
            $table->enum('kepuasan', ['0', '1', '2'])->default('0');
            $table->dateTime('mulai')->nullable();
            $table->dateTime('selesai')->nullable();            
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
                Schema::dropIfExists('pelayanans');
    }
}
