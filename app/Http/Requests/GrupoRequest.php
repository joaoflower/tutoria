<?php

namespace tutoria\Http\Requests;

use tutoria\Http\Requests\Request;

class GrupoRequest extends Request
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
            //'name'  =>  'min:8|max:45|required',
            'cod_prf' =>    'required',
        ];
    }
}
