<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\Controller;

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

Route::get('/', function () {
    return view('welcome');
});


# Common login for all

Route::get('login',[Controller::class,'loginPage'])->name('login');
Route::post('login',[AuthController::class,'login'])->name('doLogin');


#Student routes

Route::get('register',[Controller::class,'registerStudentPage'])->name('register-student');
Route::post('register-student',[RegisterController::class,'registerStudentUser'])->name('doStudentRegister');


#Company routes

Route::get('company/register',[Controller::class,'registerCompanyPage'])->name('register-company');
Route::post('register-company',[RegisterController::class,'registerCompanyUser'])->name('doCompanyRegister');


#Verification link routes

Route::get('verify-email/{token}',[AuthController::class,'doVerifyEmail']);
Route::post('send-verification-link',[AuthController::class,'sendVerificationLink'])->name('sendVerificationLink');