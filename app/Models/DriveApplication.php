<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\PlacementDrive;
use App\Models\Student;

class DriveApplication extends Model
{
    use HasFactory;

    protected $table = 'drive_applications';

    protected $fillable = [
        'drive_id',
        'student_id',
        'student_resume',
        'status'
    ];

    public function drive():BelongsTo{
        return $this->belongsTo(PlacementDrive::class);
    }

    public function student():BelongsTo{
        return $this->belongsTo(Student::class);
    }
}
