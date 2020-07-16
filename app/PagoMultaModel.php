<?php

namespace sisOTB;

use Illuminate\Database\Eloquent\Model;

class PagoMultaModel extends Model
{
    protected $table='pagomulta';
  protected $primaryKey='idPagoMulta';
  public $timestamps=false;
  protected $fillable=[
      'idMulta',
      'monto',
      'fechaPago',
      'idUsuario'
  ];
}
