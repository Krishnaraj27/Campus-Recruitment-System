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
                'email' => ['required','regex:/^[0-9]{12}+@(?:git.org.in|gandhinagaruni.ac.in)$/','unique:users,email','max:60'],
                'password' => 'required|min:5|max:20',
                'confirm_password' => 'required|same:password',
                'first_name' => 'required|alpha:ascii|max:50',
                'last_name' => 'required|alpha:ascii|max:50',
                'enrollment' => 'required|digits:12|unique:students,enrollment',
                'course' => 'required',
                'semester' => 'required|max:8|digits:1',
                'mobile' => 'required|digits:10|unique:students,mobile',
                'gender' => 'required|in:male,female',
                'date_of_birth' => 'required|date|before:today',
                'cgpa' => 'required|decimal:0,2|max:10',
                'backlogs' => 'required|integer',
                'personal_email' => 'required|regex:/^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/|unique:students,personal_email|max:60',
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
            'first_name.alpha' => 'Name should contain alphabets only',
            'last_name.alpha' => 'Name should contain alphabets only',
            'enrollment.digits' => 'Enrollment should be exactly 12 digits number',
            'enrollment.unique' => 'This enrollment has already been registered. If this is your\'s, kindly contact admin',
            'mobile.digits' => 'Mobile number should be exactly 10 digits only',
            'date_of_birth.before' => 'Date of birth could not be after today',
            'personal_email.regex' => 'Enter valid personal email ID',
            'personal_email.unique' => 'This personal email ID is already used. Kindly use another',
            'cgpa.decimal' => 'Please enter valid cgpa in decimal only',
            'backlogs.integer' => 'Please enter valid number of backlogs' 
        ];
    }
}
