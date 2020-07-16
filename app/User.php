<?php

namespace sisOTB;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
     protected $table='users';
     protected $primaryKey='id';
    protected $fillable = [
      'nombre',
      'apellidoP',
      'apellidoM',
      'carnetIdentidad',
      'foto',
      'idRol',
      'name',
      'email',
      'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
}
