<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CoordinacionMigration extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tCoordinacion', function (Blueprint $table) {
            $table->string('idCoordinacion')->unique();
            $table->string('vNombreCoordinacion');
            $table->timestamps();
            $table->softDeletes();

            $table->primary('idCoordinacion');  
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('tcoordinacion');
    }
}
