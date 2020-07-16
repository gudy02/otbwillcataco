<?php

namespace sisOTB;

use Illuminate\Database\Eloquent\Model;

class TipoMultaModel extends Model
{
  protected $table='tipoMulta';
  protected $primaryKey='idTipoMulta';
  public $timestamps=false;
  protected $fillable=[
    'nombre'
  ];
}
