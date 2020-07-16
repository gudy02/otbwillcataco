<?php

namespace sisOTB;

use Illuminate\Database\Eloquent\Model;

class TipoMonedaModel extends Model
{
  protected $table='tipoMoneda';
  protected $primaryKey='idTipoMoneda';
  public $timestamps=false;
  protected $fillable=[
    'tipoCambio'
  ];
}
