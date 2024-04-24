<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\DriveApplication;
use App\Models\PlacementDrive;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CompanyController extends Controller
{
    
    public function dashboardPage(Request $request){
        
        $user = Auth::user();
        $userCompany = $user->company;
        
        $title = 'Dashboard';
        return view('company.index',['user'=>$user,'company'=>$userCompany,'title'=>'Dashboard']);
        
    }


    public function createDrive(Request $request){
        try {

            if($request->date < $request->application_deadline){
                return redirect()->back()->with('error','Application deadline should be before drive date');
            }

            DB::beginTransaction();
            
            $user = Auth::user();
            $company = $user->company;

            $drive = PlacementDrive::create([
                'company_id'=>$company->id,
                'title'=> $request->title,
                'description' => $request->description,
                'date' => $request->date,
                'application_deadline' => $request->application_deadline,
                'mode' => $request->mode,
                'min_cgpa' => $request->min_cgpa,
                'max_backlogs' => $request->max_backlogs,
            ]);

            DB::commit();
            return redirect()->route('companyDashboard')->with('success','Drive Created Successfully');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->with('error','Something went wrong')->with('error_message',$th->getMessage());
        }
    }


    public function viewDrivePage(Request $request){
        try {
            $user = Auth::user();
            $company = $user->company;
            $id = base64_decode($request->id);
            $drive = PlacementDrive::where('company_id',$company->id)->find($id);

            if(!$drive){
                return redirect()->back()->with('error','Drive not found');
            }

            return view('company.view_drive',['drive'=>$drive,'company'=>$company]);
        } catch (\Throwable $th) {
            return redirect()->back()->with('error','Something went wrong')->with('error_message',$th->getMessage());
        }
    }


    public function viewDriveApplicationsPage(Request $request){
        try {
            $driveId = base64_decode($request->drive_id);
            $drive = PlacementDrive::with('applications')->find($driveId);

            return view('company.view_applications',['drive'=>$drive,'applications'=>$drive->applications]);
        } catch (\Throwable $th) {
            return redirect()->back()->with('error','Something went wrong')->with('error_message',$th->getMessage());
        }
    }


    public function viewApplicationPage(Request $request){
        try {
            $applicationId = base64_decode($request->id);
            $application = DriveApplication::with('student')->find($applicationId);

            return view('company.view_application',['application'=>$application,'student'=>$application->student,'title'=>'View Application']);
        } catch (\Throwable $th) {
            return redirect()->back()->with('error','Something went wrong')->with('error_message',$th->getMessage());
        }
    }


    public function editProfilePage(Request $request){
        try {
            $user = Auth::user();
            $userCompany = $user->company;
            
            return view('company.edit_profile',['user'=>$user,'company'=>$userCompany,'title'=>'Edit Profile']);
        } catch (\Throwable $th) {
            return redirect()->back()->with('error','Something went wrong')->with('error_message',$th->getMessage());
        }
        
    }


    public function viewProfilePage(Request $request){

        try {
            $user = Auth::user();
            $userCompany = $user->company;
            
            return view('company.view_profile',['user'=>$user,'company'=>$userCompany,'title'=>'View Profile']);
        } catch (\Throwable $th) {
            return redirect()->back()->with('error','Something went wrong')->with('error_message',$th->getMessage());
        }
        
    }

    
}
