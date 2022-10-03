<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Http\Requests\PhoneTypeRequest;

class StorePhoneTypeRequest extends PhoneTypeRequest;
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
            'name' => 'required|unique:phone_types',
        ], $rules);
        return $rules;
    }
}
