<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Partida extends Model
{
    protected $table = "partida";
	protected $fillable = ['idPartida','idPresupuesto','estado','saldo','descripcion'];
    public $timestamps = false;
}
