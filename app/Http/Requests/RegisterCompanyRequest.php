<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterCompanyRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'email'=>'required|unique:users,email|max:60',
            'password'=>'required|min:5|max:20',
            'name'=>'required|max:70',
            'description'=>'required|max:500',
            'address'=>'required|max:250',
            'website_url'=>'required|max:250',
            'mobile'=>'required|digits:10|unique:companies,mobile',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'email.unique' => 'This email ID is already used. Kindly use another or do login with this email',
            'mobile.digits' => 'Mobile number should be exactly 10 digits only',
            'mobile.unique'=>'This mobile number is already used. Kindly use another one',
            'password.min' => 'Password length must be minimum 5 characters',
            'password.max' => 'Password length cannot be greater than 5 characters'

        ];
    }
}
