<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;

class FieldRequest extends FormRequest
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
            'first_string' => 'string|min:2|max:255|required',
            'second_string' => 'string|min:2|max:255|required',
        ];
    }

    /**
     * @param \Illuminate\Contracts\Validation\Validator $validator
     * @return void
     * @throws ValidationException
     */
    protected function failedValidation(\Illuminate\Contracts\Validation\Validator $validator)
    {
        $response = new Response(
            [
                'status' => 'error',
                'errors' => $validator->errors()
            ],
            422
        );

        throw new ValidationException($validator, $response);
    }
}
