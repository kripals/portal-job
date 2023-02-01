<?php

namespace App\Http\Requests\Admin\UserDetail;

use Illuminate\Foundation\Http\FormRequest;

class UserDetailRequest extends FormRequest
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
        $rule =[
            'title' => 'required',
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed',
            'gender' => 'required',
            'username' => 'required|unique:users',
            'mobile' => 'required|regex:/^(\+\d{1,3}[- ]?)?\d{10}$/',
        ];
        return $rule;
    }
}
