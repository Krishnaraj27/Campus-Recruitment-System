<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Support\Facades\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    

    public function registerStudentPage(Request $request){
        $user = Auth::user();
        
        if(!$user){
            $title = 'Student Register';
            return view('student.register_student',compact('title'));
        }
        elseif($user->type=='company'){
            return redirect()->route('company-dashboard');
        }
        elseif($user->type=='admin'){
            return redirect()->route('admin-dashboard');
        }
        else{
            return redirect()->route('student-dashboard');
        }
        
    }

    public function registerCompanyPage(Request $request){
        $user = Auth::user();
        
        if(!$user){
            return view('company/register_company');
        }
        elseif($user->type=='company'){
            return redirect()->route('company-dashboard');
        }
        elseif($user->type=='admin'){
            return redirect()->route('admin-dashboard');
        }
        else{
            return redirect()->route('dashboard');
        }
        
    }

   
}
