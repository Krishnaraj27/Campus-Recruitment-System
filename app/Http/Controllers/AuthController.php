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

    public function login(Request $request){

        $credentials = $request->validate([
            'email'=>'required',
            'password'=> 'required'
        ]);

        try {
            
            if(Auth::validate($credentials)){
            
                $user = User::where('email',$request->email)->first();

                if($user->email_verified_at==null){
        
                    return redirect()->route('verify-email')->with(['message','userId'],['Your email ID is not verified. Please verify it by clicking the verification link sent to your registered email ID.',$user->id]); 

                }
                else{

                    Auth::login($user);

                    if($user->type=='student'){
                        return redirect()->route('dashboard');
                    }
                    elseif($user->type=='company'){
                        return redirect()->route('company-dashboard');
                    }
                    elseif($user->type=='admin'){
                        return redirect()->route('admin-dashboard');
                    }
                }
            }
            else{
                return back()->withErrors(['error'=>'Incorrect Credentials']);
            }

        } catch (\Throwable $th) {
            return back()->withErrors(['error'=>$th->getMessage()]);
        }

       
    }

    public function logout(Request $request){
        
        Auth::logout();

        $request->session()->invalidate();

        return redirect()->route('login');

    }

    public function doVerifyEmail(Request $request){
        $email = base64_decode($request->token);

        $user = User::where('email',$email)->get();

        if(!$user){
            return redirect()->route('login')->with('error','Invalid Request');
        }
        elseif($user->email_verified_at != null){
            return redirect()->route('home');
        }
        else{
            try {
                DB::beginTransaction();
                $user->email_verified_at = now();
                $user->save();

                if($user->type == 'student'){
                    $user->assignRole('student');
                }
                elseif($user->type == 'company'){
                    $user->assignRole('company');
                }

                DB::commit();

                return redirect()->route('login')->with('success','Email verified successfully. Please login again');
            } catch (\Throwable $th) {
                DB::rollBack();
                return redirect()->route('login')->with('error','Something went wrong. Try again');
            }
            
        }
    }

    public function sendVerificationLink(Request $request){
        
        $user = User::find($request->id);
        $url = 'http://127.0.0.1:8000/verify-email/' . base64_encode($user->email);
        if($user->type == 'student'){
            $student  = Student::where('user_id',$user->id)->get();
            $name = $student->first_name . ' ' . $student->last_name;
        }
        elseif($user->type == 'company'){
            $company = Company::where('user_id',$user->id)->get();
            $name = $company->name;
        }

        dispatch(new SendVerificationMail(['url'=>$url,'name'=>$name]));

        return redirect()->route('verify-email')->with(['message','userId'],['A verification link has been sent to your registered email address',$user->id]); 

    }
}
