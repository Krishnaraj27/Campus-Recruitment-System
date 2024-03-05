<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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
}
