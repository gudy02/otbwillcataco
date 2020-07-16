<?php

namespace sisOTB;

use Illuminate\Database\Eloquent\Model;

class CobroAguaModel extends Model
{
    protected $table='cobroagua';
    protected $primaryKey='idCobroAgua';
    public $timestamps=false;
    protected $fillable=[
        'monto',
        'idLectura',
        'fechaCobro',
        'idUsuario',
        'concepto'
    ];
}
