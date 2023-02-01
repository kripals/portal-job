<?php

namespace App\Http\Requests\Front\Company;

use Illuminate\Foundation\Http\FormRequest;

class CompanyRegisterRequest extends FormRequest
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
        $rules = [
            'organization_name' => 'required|max:255',
            'organization_type' => 'required',
            'contact_number'    => 'required|min:10',
            'email'             => 'required|string|max:255|email|unique:users',
            'password'          => 'required|string|min:8|confirmed',
            'reg_id'           => 'required|numeric|min:6'
        ];

        return $rules;
    }
}
