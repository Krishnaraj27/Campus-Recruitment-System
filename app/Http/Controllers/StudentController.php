<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function dashboardPage(Request $request){
        
        $user = Auth::user();
        $userStudent = $user->student;

        return view('student.index',['user'=>$user,'student'=>$userStudent,'title'=>'Dashboard']);

    }
}
