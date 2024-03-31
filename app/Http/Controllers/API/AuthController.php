<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Student;
use App\Models\Company;

class AuthController extends Controller
{
    
    public function login(Request $request){

        $credentials = $request->validate([
            'email'=>'required',
            'password'=> 'required'
        ]);

        try {
            
            if(Auth::attempt($credentials)){
            
                $user = User::where('email',$request->email)->first();
              
                if($user->type=='student'){
                    $redirect = 'dashboard';
                }
                elseif($user->type=='company'){
                    $redirect = 'companyDashboard';
                }
                elseif($user->type=='admin'){
                    $redirect = 'adminDashboard';
                }

                return response(['success'=>true,'message'=>'Logged in successfully','redirect'=>$redirect]); 
                
            }
            else{
                return response(['success'=>false,'message'=>'Incorrect credentials']);
            }

        } catch (\Throwable $th) {
            return response(['success'=>false,'message'=>'Something went wrong. Please try again','error'=>$th->getMessage()]);
        }

       
    }

    public function logout(Request $request){
        
        Auth::logout();

        $request->session()->invalidate();

        return response(['success'=>true,'message'=>'Logged out successfully','redirect'=>'login']);

    }
}
