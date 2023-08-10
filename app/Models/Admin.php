<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;

class Admin extends Model
{
    use HasFactory;
    use HasApiTokens;
    protected $guarded = [];

    public function Image(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $value ? route('v1:show', $value) : $value,
        );
    }
}
