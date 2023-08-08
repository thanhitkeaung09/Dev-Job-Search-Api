<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;

class OTP extends Model
{
    use HasFactory;
    use HasApiTokens;
    protected $guarded = [];

    protected $casts = [
        'expired_at' => 'datetime'
    ];
}
