<?php

namespace sisOTB;

use Illuminate\Database\Eloquent\Model;

class PagoAccionModel extends Model
{
  protected $table='pagoaccion';
  protected $primaryKey='idPagoAccion';
  public $timestamps=false;
  protected $fillable=[
      'numeroPago',
      'monto',
      'fechaPago',
      'idCobroAccion',
      'proximoPago',
      'idUsuario'
  ];
}
