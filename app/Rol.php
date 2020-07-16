<?php

namespace sisOTB;

use Illuminate\Database\Eloquent\Model;

class Rol extends Model
{
    protected $table='rol';
    protected $primaryKey='idRol';
    public $timestamps=false;
    protected $fillable=[
        'nombre',
        'estado'
    ];
}
