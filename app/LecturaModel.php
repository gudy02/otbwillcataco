<?php

namespace sisOTB;

use Illuminate\Database\Eloquent\Model;

class LecturaModel extends Model
{
    protected $table='lectura';
    protected $primaryKey='idLectura';
    public $timestamps=false;
    protected $fillable=[
      'lecturaAnterior',
      'lecturaActual',
      'idMedidor',
      'fechaLectura',
      'idUsuario',
      'cantidadConsumo',
      'mes',
      'year'
    ];
}
