<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterStudentRequest extends FormRequest
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
                'email' => 'required|regex:/^[0-9]{12}+@(?:git.org.in|gandhinagaruni.ac.in)$/|unique:users,email|max:60',
                'password' => 'required',
                'confirm_password' => 'required|same:password',
                'first_name' => 'required|alpha:ascii|max:50',
                'last_name' => 'required|alpha:ascii|max:50',
                'enrollment' => 'required|digits:12',
                'course' => 'required',
                'semester' => 'required|digits:1',
                'mobile' => 'required|digits:10|unique:students,mobile',
                'gender' => 'required|in:male,female',
                'date_of_birth' => 'required|date|before:today',
                'personal_email' => 'required|regex:/^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/|unique:students,personal_email|max:60',
                'cgpa' => 'required|decimal:2',
                'backlogs' => 'required|integer'
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
            'email.regex' => 'Enter valid email ID(your college/university ID)',
            'email.unique' => 'This email ID is already used. Kindly use another or do login with this email',
            'password.regex' => 'Password pattern does not match',
            'first_name.alpha' => 'Name should contain alphabets only',
            'last_name.alpha' => 'Name should contain alphabets only',
            'enrollment.digits' => 'Enrollment should be exactly 12 digits number',
            'mobile.digits' => 'Mobile number should be exactly 10 digits only',
            'date_of_birth.before' => 'Date of birth could not be after today',
            'personal_email.regex' => 'Enter valid personal email ID',
            'personal_email.unique' => 'This personal email ID is already used. Kindly use another',
            'cgpa.decimal' => 'Please enter valid cgpa in decimal only',
            'backlogs.integer' => 'Please enter valid number of backlogs' 
        ];
    }
}
