<?php

namespace sisOTB\Http\Requests;

use sisOTB\Http\Requests\Request;

class CobroAccionFormRequest extends Request
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
          'accion'=>'required',
          'tipoPago'=>'required',
          'tipoMoneda'=>'required'
        ];
    }
}
