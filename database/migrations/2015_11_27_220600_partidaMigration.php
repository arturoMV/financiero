<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PartidaMigration extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tPartida',function(Blueprint $table){
            $table->string('idPartida');
            $table->string('tPresupuesto_idPresupuesto');
            $table->string('estado');
            $table->integer('saldo');
            $table->string('descripcion');
            $table->timestamps();
            $table->softDeletes();
         
            $table->primary('idPartida');  
            $table->foreign('tPresupuesto_idPresupuesto')->references('idPresupuesto')->on('tPresupuesto');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('tPartida');
    }
}
