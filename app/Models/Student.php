<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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

}
