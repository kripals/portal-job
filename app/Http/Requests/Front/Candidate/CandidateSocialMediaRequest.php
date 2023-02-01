<?php

namespace App\Http\Requests\Front\Candidate;

use Illuminate\Foundation\Http\FormRequest;

class CandidateSocialMediaRequest extends FormRequest
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
            'social_media_value'          => 'required',
        ];

        return $rules;
    }
}
