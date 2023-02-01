<?php

namespace App\Http\Requests\Front\Candidate;

use Illuminate\Foundation\Http\FormRequest;

class CandidatePrivacyRequest extends FormRequest
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
            'company_pan' => 'nullable|exists:companies,company_reg_no'
        ];

        return $rules;
    }

    public function messages()
    {
        return [
            'company_pan.exists'  => 'This registration number does not belongs to any registered company in our records.',
        ];
    }

}
