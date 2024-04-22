<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Student;
use App\Models\Company;
use App\Jobs\SendVerificationMail;

class AuthController extends Controller
{

    public function loginPage()
    {        
        $title = 'Login';
        return view('login',compact('title'));    
    }


    public function login(Request $request)
    {

        try {
            $credentials = $request->validate([
                'email' => 'required',
                'password' => 'required'
            ]);

            if (Auth::attempt($credentials)) {

                $user = Auth::user();
                // Auth::login($user);

                if ($user->type == 'student') {
                    return redirect()->route('dashboard')->with('success', 'Logged in succesfully');
                } elseif ($user->type == 'company') {
                    return redirect()->route('companyDashboard')->with('success', 'Logged in succesfully');
                } elseif ($user->type == 'admin') {
                    return redirect()->route('adminDashboard')->with('success', 'Logged in succesfully');
                }

                return redirect()->back()->with('error', 'Invalid request');
            } else {
                return redirect()->back()->with('error', 'Incorrect Credentials');
            }
        } catch (\Throwable $th) {
            return redirect()->back()->with('error','Something went wrong')->with('error_message',$th->getMessage());
        }
    }


    public function logout(Request $request)
    {
        try {
            Auth::logout();

            $request->session()->invalidate();

            return redirect()->route('login')->with('success', 'Logged out succesfully');
        
        } catch (\Throwable $th) {
            return redirect()->back()->with('error','Something went wrong')->with('error_message',$th->getMessage());
        }       
    }

    
    public function doVerifyEmail(Request $request)
    {
        try {
            DB::beginTransaction();
            
            $email = base64_decode($request->token);

            $user = User::where('email', $email)->with('student')->first();

            $redirectRoute = Auth::check() ? 'dashboard' : 'login';

            if (!$user) {
                DB::rollBack();
                return redirect()->route($redirectRoute)->with('error', 'Invalid Request');
            } elseif ($user->email_verified_at != null) {
                DB::rollBack();
                return redirect()->route($redirectRoute)->with('error', 'You have already verified');
            } else {
                
                $user->email_verified_at = now();
                $user->student->status = 'active';                
                $user->assignRole('student');
                $user->student->save();
                $user->save();

                DB::commit();

                return redirect()->route($redirectRoute)->with('success', 'Email verified successfully. Please login again');

            }
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->route('dashboard')->with('error','Something went wrong')->with('error_message', $th->getMessage());
        }
    }


    public function sendVerificationLink(Request $request)
    {
        try {
            
            $user = Auth::user();
           
            $url = env('APP_URL','http://localhost/workspace/Campus-Recruitment-System/public').'/verify-email/' . base64_encode($user->email);
 
            $student  = Student::where('user_id', $user->id)->get();
            
            $name = $student->first_name . ' ' . $student->last_name;
   
            dispatch(new SendVerificationMail(['url' => $url, 'name' => $name]));
    
            return redirect()->back()->with('success', 'A verification link has been sent to your registered email address');

        } catch (\Throwable $th) {
            return redirect()->back()->with('error','Something went wrong')->with('error_message',$th->getMessage());
        }
        
    }
}
