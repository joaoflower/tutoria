<?php

namespace tutoria\Http\Requests;

use tutoria\Http\Requests\Request;

class InduccionRequest extends Request
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
            #'estugrupo_id'   => 'required',
            'tem_pro'   => 'min:20|max:1000|required',
            'fecha'   => 'date|required',
        ];
    }
}
