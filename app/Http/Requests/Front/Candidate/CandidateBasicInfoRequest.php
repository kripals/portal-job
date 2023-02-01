<?php

namespace App\Http\Requests\Front\Candidate;

use Illuminate\Foundation\Http\FormRequest;

class CandidateBasicInfoRequest extends FormRequest
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
            'gender' => 'required',
            'birth_date' => 'required',
            'nationality'=>'required',
            'marital_status' => 'required',
            'religion'=>'required',
            'current_address'=>'required',
            'permanent_address'=>'required',
            'resume'=> 'max:2048|mimes:doc,docx,pdf,txt'
        ];

        return $rules;
    }
}
