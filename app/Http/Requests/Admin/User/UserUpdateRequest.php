<?php

namespace App\Http\Requests\Admin\User;

use App\Modules\Models\User\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserUpdateRequest extends FormRequest
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
        $user = User::whereSlug($this->request->get('slug'))->first();
        $rules = [
            'first_name' => 'required',
            'last_name' => 'required',
            'gender' => 'required',
            "mobile"=> ['required','regex:/^(\+\d{1,3}[- ]?)?\d{10}$/', Rule::unique('users')->ignore($user->id)]
        ];
        return $rules;
    }

    public function messages()
    {
        return [
            'first_name.required' => 'Please enter a First Name',
            'last_name.required' => 'Please enter a Last Name',
            'gender.required'  => 'Please choose a gender',
            'mobile.required'  => 'Please enter a contact',
            'mobile.regex'  => 'Should be of 10 digit',
        ];
    }
}
