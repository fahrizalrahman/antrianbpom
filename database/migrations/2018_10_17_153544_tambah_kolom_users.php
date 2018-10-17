<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TambahKolomUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function($table) {
            $table->string('npwp')->nullable();
            $table->string('nama_perusahaan')->nullable();
            $table->string('email_perusahaan')->nullable();
            $table->string('no_telp_perusahaan')->nullable();            
            $table->string('alamat_perusahaan')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function($table) {
            $table->dropColumn('npwp');
            $table->dropColumn('nama_perusahaan');
            $table->dropColumn('email_perusahaan');
            $table->dropColumn('no_telp_perusahaan');            
            $table->dropColumn('alamat_perusahaan');
        });
    }
}
