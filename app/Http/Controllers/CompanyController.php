<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CompanyController extends Controller
{
    
    public function dashboardPage(Request $request){
        
        $user = Auth::user();
        $userCompany = $user->company;
        
        $title = 'Dashboard';
        return view('company.index',['user'=>$user,'company'=>$userCompany,'title'=>'Dashboard']);
        
    }
    
}
