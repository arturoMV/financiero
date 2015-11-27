<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PresupuestoMigration extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tPresupuesto',function(Blueprint $table){
            $table->integer('id');
            $table->string('idPresupuesto')->unique();
            $table->string('tCoordinacion_idCoordinacion');
            $table->string('vNombrePresupuesto');

    
            $table->timestamps();
            $table->softDeletes();
         
            $table->primary('idPresupuesto');  
            $table->foreign('tCoordinacion_idCoordinacion')->references('idCoordinacion')->on('tCoordinacion');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('tPresupuesto');
    }
}
