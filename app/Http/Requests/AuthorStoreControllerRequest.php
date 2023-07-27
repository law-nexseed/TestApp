<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AuthorStoreControllerRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'string|required',
            'desc' => 'string|nullable'
        ];
    }

    public function messages()
    {
        return [
            'name.string' => 'Name should be string' ,
            'name.required' => 'Name should be required' ,
            'desc.string' => 'desc should be string' ,
        ];
    }
}
