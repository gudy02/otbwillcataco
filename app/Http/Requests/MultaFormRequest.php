<?php

namespace sisOTB\Http\Requests;

use sisOTB\Http\Requests\Request;

class MultaFormRequest extends Request
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
            'concepto'=>'required',
            'socio'=>'required|integer|not_in:0',
            'monto'=>'required',
            'fecha'=>'required',
        ];
    }
    public function messages(){
        return [
          'socio.required'=>'nombre',
          'socio.integer'=>'El campo Socio es requerido'
        ];
      }

      public function attributes(){
        return [
          'socio'=>'socio',
        ];
      }
}
