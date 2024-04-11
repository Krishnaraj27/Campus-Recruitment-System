<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\PlacementDrive;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Company extends Model
{
    use HasFactory;

    protected $table = "companies";

    protected $fillable = [
        'user_id',
        'name',
        'description',
        'address',
        'website_url',
        'mobile',
        'verified_at'
    ];

    public function user(): BelongsTo{
        return $this->belongsTo(User::class);
    }

    public function drives():HasMany{
        return $this->hasMany(PlacementDrive::class);
    }
}
