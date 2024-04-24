<?php

namespace App\Http\Controllers;

use App\Helpers\DriveHelper;
use App\Http\Controllers\Controller;
use App\Models\PlacementDrive;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class StudentController extends Controller
{

    public $driveHelper;

    public function __construct(DriveHelper $driveHelper)
    {
        parent::__construct();
        $this->driveHelper = $driveHelper;
    }

    public function dashboardPage(Request $request){
        
        $user = Auth::user();
        $userStudent = $user->student;

        $upcomingDrives = PlacementDrive::where('status','active')->get();

        $upcomingDrives = $upcomingDrives->map(function($drive) use ($userStudent){
            if(!$this->driveHelper->driveHasStudent($drive->id,$userStudent->id)){
                return $drive;
            }
        });

        $appliedDrives = $upcomingDrives->map(function($drive) use ($userStudent){
            if($this->driveHelper->driveHasStudent($drive->id,$userStudent->id)){
                return $drive;
            }
        });

        return view('student.index',['user'=>$user,'student'=>$userStudent,'upcomingDrives'=>$upcomingDrives,'appliedDrives'=>$appliedDrives,'title'=>'Dashboard']);

    }

    
    public function viewDrivePage(Request $request){
        try {
            $driveId = base64_decode($request->id);
            $drive = PlacementDrive::with('company')->find($driveId);

            $user = Auth::user();

            $applied = $this->driveHelper->driveHasStudent($drive->id,$user->student->id);

            return view('student.view_drive',['drive'=>$drive,'applied'=>$applied,'title'=>'View Drive']);
        } catch (\Throwable $th) {
            return redirect()->route('dashboard')->with('error','Something Went Wrong')->with('error_message',$th->getMessage());
        }
    }

}
