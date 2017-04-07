<?php

namespace tutoria\Http\Requests;

use tutoria\Http\Requests\Request;

class UserEditRequest extends Request
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
            'email' => 'min:4|max:250|required',
            'username'  => 'min:4|max:120|required', 
            'password' => 'min:4|max:120|required'
        ];
    }
}
