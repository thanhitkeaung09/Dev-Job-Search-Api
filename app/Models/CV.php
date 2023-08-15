<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CV extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function cv():Attribute
    {
        return Attribute::make(
            get: fn ($value) => $value ? route('v1:show', $value) : $value,
        );
    }

    public function job()
    {
        return $this->belongsTo(Job::class);
    }
}
