<?php

namespace App\Http\Requests\Front\Candidate;

use Illuminate\Foundation\Http\FormRequest;

class CandidateExperienceRequest extends FormRequest
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
            'company_name'            => 'required',
            'company_category_id'     => 'required',
            'experience_job_title'    => 'required',
            'candidate_category_id'   => 'required',
            'experience_job_level_id' => 'required',
            'experience_location_id'  => 'required',
            'experience_start_date'   => 'required',
            'experience_end_date'     => 'required'
        ];

        return $rules;
    }
}
