<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Partida extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Partida',function(Blueprint $table){
            $table->increments('id');
            $table->string('idPartida')->unique();
            $table->string('idPresupuesto')->unique();
            $table->string('estado');
            $table->integer('saldo');
            $table->string('descripcion');
         

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('Partida');
    }
}
