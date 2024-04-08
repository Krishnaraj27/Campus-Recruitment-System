<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function dashboardPage(Request $request){
        
        $user = Auth::user();
        
        if(!$user){
            return redirect()->route('login')->with('message','Please login');
        }
        elseif($user->type=='company'){
            return redirect()->route('companyDashboard');
        }
        elseif($user->type=='admin'){
            return redirect()->route('adminDashboard');
        }
        else{
            $userStudent = $user->student;
            return view('index',['user'=>$user,'student'=>$userStudent]);
        }

    }
}
