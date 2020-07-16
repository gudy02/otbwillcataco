<?php

namespace sisOTB;

use Illuminate\Database\Eloquent\Model;

class EgresoModel extends Model
{
    protected $table='gastos';
    protected $primaryKey='id';
    public $timestamps=false;
    protected $fillable=[
        'idGasto',
        'tipo_id',
        'numComprobante',
        'monto',
        'descripcion',
        'fecha',
        'user_id',
        'fecha_registro'
    ];
}
