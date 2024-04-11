<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\DriveApplication;
use App\Models\Company;

class PlacementDrive extends Model
{
    use HasFactory;

    protected $table = 'placement_drives';

    protected $fillable = [
        'company_id',
        'title',
        'description',
        'date',
        'application_deadline',
        'mode',
        'min_cgpa',
        'max_backlogs',
        'status'
    ];

    public function company():BelongsTo{
        return $this->belongsTo(Company::class);
    }

    public function applications():HasMany{
        return $this->hasMany(DriveApplication::class);
    }

}
