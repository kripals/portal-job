<?php

namespace App\Http\Requests\Front\Candidate;

use Illuminate\Foundation\Http\FormRequest;

class CandidateReferenceRequest extends FormRequest
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
            'reference_name'         => 'required',
//            'company_name' => 'required',
            'reference_designation'  => 'required',
//            'email'        => 'required|string|max:255|email',
//            'phone'        => 'required|min:10',
//            'phone2'       => 'required|min:10',
        ];

        return $rules;
    }
}
