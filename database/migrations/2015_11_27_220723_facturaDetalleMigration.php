<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class FacturaDetalleMigration extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */   
    public function up()
    {
        Schema::create('tFacturaDetalle', function (Blueprint $table) {
            $table->integer('id');
            $table->string('tFactura_idFactura')->unique();
            $table->integer('iLinea');
            $table->string('vDetalle');
            $table->integer('iPrecio');
            $table->integer('iCantidad');
            $table->integer('iTotalLinea');
            
            $table->timestamps();
            $table->softDeletes();

            $table->primary('tFactura_idFactura');
            $table->foreign('tFactura_idFactura')->references('idFactura')->on('tFactura');
  
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('tFacturaDetalle');
    }
}
