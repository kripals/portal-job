<?php

namespace App\Http\Requests\Front\Candidate;

use Illuminate\Foundation\Http\FormRequest;

class CandidateEducationRequest extends FormRequest
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
            'qualification_level'=>'required',
            'program_name'=>'required',
            'education_board'=>'required',
            'institute_name'=>'required',
            'marks_obtained'=>'required',
        ];

        return $rules;
    }
}
