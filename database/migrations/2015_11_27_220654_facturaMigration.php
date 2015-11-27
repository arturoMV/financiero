<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class FacturaMigration extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tFactura', function (Blueprint $table) {
            $table->integer('id');
            $table->string('idFactura')->unique();
            $table->string('tPartida_idPartida');
            $table->string('vTipoFactura');
            $table->date('dFechaFactura');
            $table->string('vDescripcionFactura');
            $table->float('fMontoFactura');
            
            $table->timestamps();
            $table->softDeletes();

            $table->primary('idFactura');
            $table->foreign('tPartida_idPartida')->references('idPartida')->on('tPartida');
  
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('tFactura');
    }
}

