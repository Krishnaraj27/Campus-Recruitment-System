<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\User;
use App\Models\Student;
use App\Http\Requests\RegisterStudentRequest;

class UserController extends Controller
{
    public function registerStudentUser(RegisterStudentRequest $request){

        try {
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
                'status' => $request->status,
                'personal_email' => $request->personal_email,
                'cgpa' => $request->cgpa,
                'backlogs' => $request->backlogs
            ]);

            return Response(['success'=>true,'message'=>'Student registered successfully'],200);    

        } catch (\Throwable $th) {
            return Response(['success'=>true,'message'=>'Cannot register student','error'=>$th->getMessage()],200);
            // return back()->withErrors($th->getMessage());
        }
        
    }

}
