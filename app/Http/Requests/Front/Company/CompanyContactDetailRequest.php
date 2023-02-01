<?php


namespace App\Http\Requests\Front\Company;


use Illuminate\Foundation\Http\FormRequest;

class CompanyContactDetailRequest extends FormRequest
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
            'address' => 'required|max:255',
        ];

        return $rules;
    }

}
