<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClientRequest extends FormRequest
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
            'phones.*.number' => 'numeric'
        ];
    }


    /**
     * Prepare the data for validation.
     *
     * @return void
     */
    protected function prepareForValidation()
    {
        $this->merge([
            'emails' => $this->formatFieldArray('emails', 'email'),
            'phones' => $this->formatFieldArray('phones', 'number'),
        ]);
    }

    /**
     * Подготавливает нужный формат массива
     */
    protected function formatFieldArray($field_name, $key_name, $need_is_main = true)
    {
        $original_field = $this->{$field_name};
        $key_main_name = 'key_main_' . $key_name;
        $new_field = [];
        foreach ($original_field as $key => $field) {
            if ($field[$key_name] !== null) {
                $new_field[$key] = $field;
                if ($need_is_main) {
                    $new_field[$key]['is_main'] = ($this->{$key_main_name} == $key ? 1 : 0);
                }
            }
        }

        return $new_field;
    }


    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'fio.required' => ':attribute обязателен для заполнения!',
            'fio.unique' => ':attribute уже используется!',
            'phones.*.number.numeric' => 'Возможны только цифры!'
        ];
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array
     */
    public function attributes()
    {
        return [
            'fio' => 'ФИО',
        ];
    }
}
