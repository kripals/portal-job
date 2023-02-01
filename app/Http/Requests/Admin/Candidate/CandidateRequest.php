<?php

namespace App\Http\Requests\Admin\Candidate;

use Illuminate\Foundation\Http\FormRequest;

class CandidateRequest extends FormRequest
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
            'user_id' => 'required|unique:candidates',
            'ref_id' => 'required',
            'category_id' => 'required',
            'job_level_id'=>'required',
            'resume'=> 'mimes:doc,docx,pdf,txt|max:2048'
        ];

        return $rules;
    }
}
