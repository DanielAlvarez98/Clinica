<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreUserRequest extends FormRequest
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
            'id_rol'=>'required',
            'name'=>'required|regex:/^[^\d]*$/',
            'lastname'=>'required|regex:/^[^\d]*$/',
            'email'=>'required|unique:employee,email',
            'birthdate'=>'required',
            'dni'=>['required','regex:/^\d{8}$/',Rule::unique('employees','dni')]
        ];
    }
}
