<?php


namespace App\Http\Requests\Front\Job;


use Illuminate\Foundation\Http\FormRequest;

class JobBasicInfoRequest extends FormRequest
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
            'title' => 'required|max:255',
            'category_id' => 'required',
            'job_service_id' => 'required',
            'end_date' => 'required',
        ];

        return $rules;
    }

}
