<?php

namespace sisOTB;

use Illuminate\Database\Eloquent\Model;

class UsuarioModel extends Model
{
      protected $table='usuario';
      protected $primaryKey='idUsuario';
      public $timestamps=false;
      protected $fillable=[
          'nombre',
          'apellidoP',
          'apellidoM',
          'carnetIdentidad',
          'foto',
          'usuario',
          'password',
          'idRol'
      ];
}
