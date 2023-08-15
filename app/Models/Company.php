<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected function Image(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $value ? route('v1:show', $value) : $value,
        );
    }

    public function job()
    {
        return $this->hasMany(Job::class);
    }
}
