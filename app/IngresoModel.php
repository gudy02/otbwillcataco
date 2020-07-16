<?php

namespace sisOTB;

use Illuminate\Database\Eloquent\Model;

class IngresoModel extends Model
{
    protected $table='ingresos';
    protected $primaryKey='id';
    public $timestamps=false;
    protected $fillable=[
        'id',
        'descripcion',
        'monto',
        'fecha',
        'user_id',
        'tipo_id',
        'fecha_registro'
    ];
}
