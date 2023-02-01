<?php

namespace App\Http\Requests\Front\Candidate;

use Illuminate\Foundation\Http\FormRequest;

class CandidateJobPreferenceRequest extends FormRequest
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
            'category_id' => 'required',
            'job_level_id' => 'required',
            'specialization'=>'required',
            'job_country_id' => 'required',
            'experience_period'=>'required',
            'exp_salary_amount'=>'required',
            'cur_salary_amount'=>'required',
            'description'=> 'required'
        ];

        return $rules;
    }
}
