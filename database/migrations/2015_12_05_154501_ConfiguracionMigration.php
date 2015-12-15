<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ConfiguracionMigration extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tConfiguracion', function(Blueprint $table){
            $table->increments('idConfiguracion');
            $table->string('vConfiguracion');
            $table->integer('iValor');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('tConfiguracion');
    }
}
