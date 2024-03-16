<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
            
            if(Auth::attempt($request)){
            
                $user = Auth()->user();
    
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
            else{
                return back()->with('error','Incorrect Credentials');
            }

        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }

       
    }

    public function logout(Request $request){
        
        Auth::logout();

        $request->session()->invalidate();

        return redirect()->route('login');

    }
}
