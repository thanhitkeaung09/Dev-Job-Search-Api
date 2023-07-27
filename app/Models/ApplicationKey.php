<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class ApplicationKey extends Model
{
    use HasFactory;

    protected $guarded = [];

    public static function generateAppId(): string
    {
        return Str::uuid()->toString();
    }

    public static function generateAppSecret(): string
    {
        return Str::uuid() . Str::uuid();
    }
}
