<?php

namespace tutoria\Http\Requests;

use tutoria\Http\Requests\Request;

class UserRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true; # autorizado para usar el request
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            //'name'  => 'min:4|max:120|required',
            'cod_car' => 'required',
            'codigo' => 'required',
            'email' => 'min:4|max:250|required',
            'username'  => 'min:4|max:120|required|unique:usutut', 
            'password' => 'min:4|max:120|required'
        ];
    }
}
