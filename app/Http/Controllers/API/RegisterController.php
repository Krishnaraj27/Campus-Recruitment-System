<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Student;
use App\Models\Company;
use App\Http\Requests\RegisterStudentRequest;
use Illuminate\Support\Facades\DB;
use App\Jobs\SendVerificationMail;

class RegisterController extends Controller
{
    public function registerStudentUser(RegisterStudentRequest $request){

        try {

            DB::beginTransaction();

            $user = User::create([
                'email' => $request->email,
                'password' => bcrypt($request->password),
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
                'status' => 'pending',
                'personal_email' => $request->personal_email,
                'cgpa' => $request->cgpa,
                'backlogs' => $request->backlogs
            ]);

            DB::commit();

            # the base64 encoded string of the user's email is sent as token to identify user from link.
            // dd($user);
            
            $url = 'http://127.0.0.1:8000/verify-email/' . base64_encode($user->email);

            dispatch(new SendVerificationMail(['url'=>$url,'name'=> $student->first_name . ' ' . $student->last_name,'email'=>$user->email]));

            return response(['success'=>true,'message'=>'Account created successfully. Please login to go to dashboard']);

        } catch (\Throwable $th) {
            DB::rollBack();
            return response(['success'=>false,'message'=>'Something went wrong. Please try again','error'=>$th->getMessage()]);
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

            $company = Company::create([
                'user_id' => $user->id,
                'name' => $request->name,
                'description' => $request->description,
                'address' => $request->address,
                'website_url' => $request->website_url,
                'mobile' => $request->mobile,
            ]);

            DB::commit();

            return response(['success'=>true,'message'=>'Account created successfully. Please login to go to dashboard']);

        } catch (\Throwable $th) {
            DB::rollBack();
            return response(['success'=>false,'message'=>'Something went wrong. Please try again','error'=>$th->getMessage()]);
        }
        
    }

}
