<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Student;
use App\Models\Company;
use App\Http\Requests\RegisterStudentRequest;
use Illuminate\Support\Facades\DB;

class RegisterController extends Controller
{
    
    public function registerStudentUser(RegisterStudentRequest $request){

        try {

            DB::beginTransaction();

            $user = User::create([
                'email' => $request->email,
                'password' => $request->password,
                'type' => 'student'
            ]);

            $student = Student::create([
                'user_id' => $user->id,
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'enrollment' => $request->enrollment,
                'course' => $request->course,
                'semester' => $request->semester,
                'mobile' => $request->mobile,
                'gender' => $request->gender,
                'date_of_birth' => $request->date_of_birth,
                'status' => 'active',
                'personal_email' => $request->personal_email,
                'cgpa' => $request->cgpa,
                'backlogs' => $request->backlogs
            ]);

            DB::commit();

            return redirect()->route('verify-email')->with(['success','message'],['Account created successfully.','An otp has been sent to your email ID. Enter below to verify your email']);


        } catch (\Throwable $th) {
            DB::rollBack();
            return back()->withErrors($th->getMessage());
        }
        
    }

    public function registerCompanyUser(Request $request){

        try {

            DB::beginTransaction();

            $user = User::create([
                'email' => $request->email,
                'password' => $request->password,
                'type' => 'company'
            ]);

            $student = Company::create([
                'user_id' => $user->id,
                'name' => $request->name,
                'description' => $request->description,
                'address' => $request->address,
                'website_url' => $request->website_url,
                'mobile' => $request->mobile,
            ]);

            DB::commit();

            return redirect()->route('verify-email')->with(['success','message'],['Account created successfully.','An otp has been sent to your email ID. Enter below to verify your email']);

        } catch (\Throwable $th) {
            DB::rollBack();
            return back()->withErrors($th->getMessage());
        }
        
    }


}
