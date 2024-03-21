<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Support\Facades\Request;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function loginPage(Request $request){
        return view('login');
    }

    public function registerStudentPage(Request $request){
        return view('register_student');
    }

    public function registerCompanyPage(Request $request){
        return view('company/register_company');
    }
}
