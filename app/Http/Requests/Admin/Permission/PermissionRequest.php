<?php

namespace App\Http\Requests\Admin\Permission;

use Illuminate\Foundation\Http\FormRequest;

class PermissionRequest extends FormRequest
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
            'name'=> 'required|unique:permissions',
            'display_name'=> 'required',
        ];
    }

    public function messages()
    {
        return [
            'name.required'=>'Name must be unique',
            'display_name.required'  => 'Please enter a display name'
        ];
    }

}
