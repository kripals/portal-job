<?php

namespace App\Http\Requests\Admin\JobLevel;

use Illuminate\Foundation\Http\FormRequest;

class JobLevelRequest extends FormRequest
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
            'title' => 'required',
        ];

        return $rules;
    }
}
