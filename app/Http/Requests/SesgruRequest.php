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
            'evalses_ids'   => 'required',
            'tem_ses'   => 'min:20|max:1000|required',
            'pro_ses'   => 'min:20|max:1000|required',
            'acu_ses'   => 'min:20|max:1000|required',
            'obs_ses'   => 'min:20|max:1000|required',
            'fecha'   => 'date|required',
            'evalses_id'   => 'required',
        ];
    }
}
