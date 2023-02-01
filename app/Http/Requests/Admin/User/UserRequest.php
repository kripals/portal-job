<?php

namespace App\Http\Requests\Admin\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
class UserRequest extends FormRequest
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
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed',
//            'username' => 'required|unique:users',
        ];
        return $rules;
    }

    public function messages()
    {
        return [
            'first_name.required' => 'Please enter a First Name',
            'last_name.required' => 'Please enter a Last Name',
            'email.required'  => 'Please enter a email',
            'password.required'  => 'Please enter a password',
//            'username.required'  => 'Please enter a username',
        ];
    }

}
