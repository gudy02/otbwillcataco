<?php

namespace sisOTB;

use Illuminate\Database\Eloquent\Model;

class AporteModel extends Model
{
    protected $table='aporte';
    protected $primaryKey='idAporte';
    public $timestamps=false;
    protected $fillable=[
        'idAporte',
        'monto',
        'idSocio',
        'fecha_cobro',
        'mes'
    ];
}
