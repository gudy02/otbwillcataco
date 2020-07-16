<?php

namespace sisOTB;

use Illuminate\Database\Eloquent\Model;

class SocioModel extends Model
{
    protected $table='socio';
    protected $primaryKey='idSocio';
    public $timestamps=false;
    protected $fillable=[
      'nombre',
      'apellidoP',
      'apellidoM',
      'carnetIdentidad',
      'foto',
      'direccion',
      'idMedidor',
      'idUsuario'
    ];
}
