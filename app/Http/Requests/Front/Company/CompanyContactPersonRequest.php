<?php


namespace App\Http\Requests\Front\Company;


use Illuminate\Foundation\Http\FormRequest;

class CompanyContactPersonRequest extends FormRequest
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
            'person_name' => 'required|max:255',
            'person_designation' => 'required',
            'person_email' => 'required',
        ];

        return $rules;
    }

}
