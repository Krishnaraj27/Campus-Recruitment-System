<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\DriveApplication;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Student extends Model
{
    use HasFactory;

    protected $table = 'students';

    protected $fillable = [
        'user_id',
        'first_name',
        'last_name',
        'enrollment',
        'course',
        'semester',
        'mobile',
        'gender',
        'date_of_birth',
        'status',
        'personal_email',
        'cgpa',
        'backlogs'
    ];

    public function user(): BelongsTo{
        return $this->belongsTo(User::class);
    }

    public function applications():HasMany{
        return $this->hasMany(DriveApplication::class);
    }

}
