<?php

namespace App\Http\Controllers;

use App\Jobs\SendRejectedMailToCompany;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Jobs\SendVerificationMailToCompany;

class AdminController extends Controller
{
    public function dashboardPage(Request $request){
        
        $user = Auth::user();
        $unverifiedCompanies = Company::where('status','pending')->get();
        $activeCompanies = Company::where('status','active')->get();
        $inactiveCompanies = Company::where('status','inactive')->get();
        
        return view('admin.index',['user'=>$user,'unverifiedCompanies'=>$unverifiedCompanies,'title'=>'Admin Dashboard']);

    }


    public function viewCompanyPage(Request $request){
        try {
            $id = base64_decode($request->id);
            $company = Company::find($id)->with('user')->first();

            return view('admin.view_company',['company'=>$company,'title'=>'View Company']);
        } catch (\Throwable $th) {
            return redirect()->route('adminDashboard')->with('error','Something Went Wrong')->with('error_message',$th->getMessage());
        }
    }


    public function verifyCompany(Request $request){
        try {
            DB::beginTransaction();
            $id = base64_decode($request->id);
            $company = Company::find($id)->with('user')->first();

            if($company->status=='pending'){
                $company->status = 'active';
                $company->save();
                DB::commit();
                dispatch(new SendVerificationMailToCompany($company->name,$company->user->email));
            }
            else{
                DB::rollBack();
                return redirect()->back()->with('message','Company is already verified');
            }

            return redirect()->back()->with('success','Company verified successfully');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->route('adminDashboard')->with('error','Something Went Wrong')->with('error_message',$th->getMessage());
        }
    }


    public function rejectCompany(Request $request){
        try {
            DB::beginTransaction();
            $id = base64_decode($request->id);
            $company = Company::find($id)->with('user')->first();

            if($company->status=='pending'){
                $email = $company->user->email;
                $name = $company->name;
                $company->delete();
                DB::commit();
                dispatch(new SendRejectedMailToCompany($name,$email));
            }
            else{
                DB::rollBack();
                return redirect()->back()->with('success','Company is already verified');
            }

            return redirect()->route('adminDashboard')->with('success','Company rejected and deleted successfully');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->route('adminDashboard')->with('error','Something Went Wrong')->with('error_message',$th->getMessage());
        }
    }


    public function blockCompany(Request $request){
        try {
            DB::beginTransaction();
            $id = base64_decode($request->id);
            $company = Company::find($id)->with('user')->first();

            if($company->status=='active'){
                $company->status = 'inactive';
                $company->save();
                DB::commit();
            }
            else{
                DB::rollBack();
                return view('admin.view_company',['company'=>$company,'title'=>'View Company','message'=>'Company is already verified']);
            }

            return view('admin.view_company',['company'=>$company,'title'=>'View Company','success'=>'Company verified successfully']);
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->route('adminDashboard')->with('error','Something Went Wrong')->with('error_message',$th->getMessage());
        }
    }

    
}
