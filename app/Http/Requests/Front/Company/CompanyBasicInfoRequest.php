<?php


namespace App\Http\Requests\Front\Company;


use Illuminate\Foundation\Http\FormRequest;

class CompanyBasicInfoRequest extends FormRequest
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
            'organization_name' => 'required|max:255',
//            'reg_no' => 'required|numeric|min:6',
            'industry' => 'required',
//            'website' => 'url'
        ];

        return $rules;
    }

}
