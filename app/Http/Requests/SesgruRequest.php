<?php

namespace tutoria\Http\Requests;

use tutoria\Http\Requests\Request;

class SesgruRequest extends Request
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
            'asi_ests'   => 'required',
            'valoraciones'   => 'required',
            'fecha'   => 'date|required',
        ];
    }
}
