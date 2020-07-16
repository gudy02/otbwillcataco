<?php

namespace sisOTB\Http\Requests;

use sisOTB\Http\Requests\Request;

class EgresoRequest extends Request
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
            'descripcion'=>'required',
            'monto'=>'required',
            'fecha'=>'required',
            'tipo_id'=>'required',
            'numComprobante' => 'required'
        ];
    }
}
