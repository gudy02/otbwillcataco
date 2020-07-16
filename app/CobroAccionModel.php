<?php

namespace sisOTB;

use Illuminate\Database\Eloquent\Model;

class CobroAccionModel extends Model
{
  protected $table='cobroaccion';
  protected $primaryKey='idCobroAccion';
  public $timestamps=false;
  protected $fillable=[
    'accion',
    'idSocio',
    'idUsuario',
    'fechaReg',
    'idTipoPago',
    'idTipoMoneda',
    'concepto'
  ];
}
