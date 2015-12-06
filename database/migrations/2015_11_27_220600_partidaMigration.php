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
            $table->integer('tPresupuesto_anno');
            $table->integer('gasto');
            $table->integer('saldo');
            $table->string('descripcion');
            $table->timestamps();
            $table->softDeletes();
         
            $table->primary('idPartida');
            $table->foreign(['tPresupuesto_idPresupuesto', 'tPresupuesto_anno'])->references(['idPresupuesto','anno'])->on('tPresupuesto');


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
