<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Permiso;

class Rol extends Model
{
    protected $table = "trol";
	protected $fillable = ['nombreRol','descripcionRol'];
    public $timestamps = false;
    protected $primaryKey = 'idRol';
}
