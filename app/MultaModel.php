<?php

namespace sisOTB;

use Illuminate\Database\Eloquent\Model;

class MultaModel extends Model
{
  protected $table='multa';
  protected $primaryKey='idMulta';
  public $timestamps=false;
  protected $fillable=[
    'concepto',
    'monto',
    'idSocio',
    'idUsuario',
    'estado',
    'fechaMulta',
    'idTipoMulta'
  ];
}
