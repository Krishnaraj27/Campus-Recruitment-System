<?php 

namespace App\Helpers;

use App\Models\DriveApplication;
use Illuminate\Support\Facades\Log;

class DriveHelper{

    public function driveHasStudent($driveId,$studentId){
        try {
            $application = DriveApplication::where('drive_id',$driveId)->where('student_id',$studentId)->first();
            
            if(count($application)>0){
                return true;
            }

            return false;

        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            throw $th;
        }
    }

}