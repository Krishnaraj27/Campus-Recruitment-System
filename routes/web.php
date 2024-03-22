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

Route::controller(Controller::class)->group(function(){
    Route::get('login','loginPage')->name('login');
    Route::get('register','registerStudentPage')->name('register-student');
    Route::get('company/register','registerCompanyPage')->name('register-company');
});

Route::controller(AuthController::class)->group(function(){
    Route::post('login','login')->name('doLogin');
});

Route::controller(RegisterController::class)->group(function(){
    Route::post('register-student','registerStudentUser')->name('doStudentRegister');
    Route::post('register-company','registerCompanyUser')->name('doCompanyRegister');
});