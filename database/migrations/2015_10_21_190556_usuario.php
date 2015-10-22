<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class usuario extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tusuariop', function (Blueprint $table) {
            $table->increments('idUsuario');
            $table->string('nombre');
            $table->string('email')->unique();
            $table->string('password', 60);
            $table->integer('tRol_idRol');
            $table->rememberToken();
            $table->timestamps();

          
            $table->foreign('tRol_idRol')->references('idRol')->on('tRol');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('users');
    }
}
