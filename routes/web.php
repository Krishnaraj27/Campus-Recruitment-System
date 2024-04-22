<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CompanyController;
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


# Common login for all and register routes (guest)

Route::middleware('guest')->group(function(){

    Route::get('login',[AuthController::class,'loginPage'])->name('login');
    Route::post('login',[AuthController::class,'login'])->name('doLogin');

    # Register routes for student
    Route::get('register',[Controller::class,'registerStudentPage'])->name('registerStudent');
    Route::post('register-student',[RegisterController::class,'registerStudentUser'])->name('doStudentRegister');

    # Register routes for company
    Route::get('company/register',[Controller::class,'registerCompanyPage'])->name('registerCompany');
    Route::post('register-company',[RegisterController::class,'registerCompanyUser'])->name('doCompanyRegister');

});

Route::post('logout',[AuthController::class,'logout'])->name('doLogout')->middleware('auth');


#Student routes
Route::middleware('auth.student')->group(function(){

    Route::get('/',[StudentController::class,'dashboardPage'])->name('dashboard');
    
});




#Company routes
Route::middleware('auth.company')->group(function(){

    Route::get('/company',[CompanyController::class,'dashboardPage'])->name('companyDashboard');
    
});


#Admin routes
Route::middleware('auth.admin')->group(function(){

    Route::get('admin',[AdminController::class,'dashboardPage'])->name('adminDashboard');
    Route::get('admin/view-company/{id}',[AdminController::class,'viewCompanyPage'])->name('adminViewCompany');
    Route::get('admin/verify-company/{id}',[AdminController::class,'verifyCompany'])->name('doVerifyCompany');
    Route::get('admin/reject-company/{id}',[AdminController::class,'rejectCompany'])->name('doRejectCompany');
    
});



#Verification link routes

Route::get('verify-email/{token}',[AuthController::class,'doVerifyEmail']);
Route::post('send-verification-link',[AuthController::class,'sendVerificationLink'])->name('sendVerificationLink');
