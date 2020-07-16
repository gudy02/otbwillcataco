<?php

namespace sisOTB;

use Illuminate\Database\Eloquent\Model;

class MedidorModel extends Model
{
  protected $table='medidor';
  protected $primaryKey='idMedidor';
  public $timestamps=false;
  protected $fillable=[
    'codigo'
  ];
}
