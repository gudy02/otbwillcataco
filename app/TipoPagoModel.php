<?php

namespace sisOTB;

use Illuminate\Database\Eloquent\Model;

class TipoPagoModel extends Model
{
  protected $table='tipoPago';
  protected $primaryKey='idTipoPago';
  public $timestamps=false;
  protected $fillable=[
    'tipo'
  ];
}
