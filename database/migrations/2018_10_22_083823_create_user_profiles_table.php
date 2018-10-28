<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_profiles', function (Blueprint $table) {
            $table->integer('id');
            $table->integer('userid');
            $table->enum('type', ['2', '1'])->default('1');
            $table->string('nama', 64)->default('-');
            $table->string('alamat', 255)->default('-');
            $table->string('no_telp', 64)->default('-');
            $table->string('no_fax', 64)->default('-');
            $table->string('email_1', 64)->unique();
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
        Schema::dropIfExists('user_profiles');
    }
}
