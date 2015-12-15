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
            $table->integer('tFactura_idFactura');
            $table->integer('iLinea');
            $table->string('vDetalle');
            $table->integer('iPrecio');
            $table->integer('iCantidad');
            $table->integer('iTotalLinea');
            
            $table->timestamps();
            $table->softDeletes();

            $table->primary(['tFactura_idFactura', 'iLinea']);
  
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
