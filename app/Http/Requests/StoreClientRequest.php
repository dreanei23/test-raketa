<?php

namespace App\Http\Requests;

class StoreClientRequest extends ClientRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = parent::rules();
        $rules = array_merge([
            'fio' => 'required|unique:clients',
        ], $rules);
        return $rules;
    }

}
