<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\StudentController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/




# Common login for all

Route::get('login',[AuthController::class,'loginPage'])->name('login')->middleware('guest');
Route::post('login',[AuthController::class,'login'])->name('doLogin')->middleware('guest');


#Student routes

Route::get('/',[StudentController::class,'dashboardPage'])->name('dashboard');
Route::get('register',[Controller::class,'registerStudentPage'])->name('registerStudent')->middleware('guest');
Route::post('register-student',[RegisterController::class,'registerStudentUser'])->name('doStudentRegister')->middleware('guest');


#Company routes

Route::get('/company',[Controller::class,'companyDashboardPage'])->name('companyDashboard');
Route::get('company/register',[Controller::class,'registerCompanyPage'])->name('registerCompany')->middleware('guest');
Route::post('register-company',[RegisterController::class,'registerCompanyUser'])->name('doCompanyRegister')->middleware('guest');


#Admin routes
Route::get('/admin',[Controller::class,'adminDashboardPage'])->name('adminDashboard')->middleware('guest');


#Verification link routes

Route::get('verify-email/{token}',[AuthController::class,'doVerifyEmail']);
Route::post('send-verification-link',[AuthController::class,'sendVerificationLink'])->name('sendVerificationLink');

Route::get('verify-email',function(){
    return view('verify_email');
})->name('verifyEmail');