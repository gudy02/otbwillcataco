<?php

namespace sisOTB\Http\Requests;

use sisOTB\Http\Requests\Request;

class SocioFormRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'nombre'=>'required|min:4',
            'apellidoP'=>'required|min:4',
            'apellidoM'=>'required|min:4',
            'carnetIdentidad'=>'required|min:4|max:8',
            'direccion'=>'required|min:4',
            'medidor'=>'required|min:4|max:30',
            // 'LecturaAnterior'=>'required|min:1'
        ];
    }
    public function messages(){
      return [
        'nombre.required'=>'El :attribute  es  Obligatorio',
        'apellidoP.required'=>'El :attribute  es  Obligatorio',
        'apellidoM.required'=>'El :attribute  es  Obligatorio',
        'carnetIdentidad.required'=>'El :attribute  es  Obligatorio',
        'direccion.required'=>'La :attribute  es  Obligatoria',
        'medidor.required'=>'El :attribute  es  Obligatorio'
      ];
    }
    public function attributes(){
      return [
        'nombre'=>'Nombre del socio',
        'apellidoP'=>'Apellido Paterno',
        'apellidoM'=>'Apellido Materno',
        'carnetIdentidad'=>'Carnet de Identidad',
        'direccion'=>'Direccion',
        'medidor'=>'Medidor'
      ];
    }
}
