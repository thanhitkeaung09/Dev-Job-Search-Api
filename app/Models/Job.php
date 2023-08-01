<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    use HasFactory;
    protected $guarded = [];

    protected function companyImage(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $value , // need to change
        );
    }
    public function users()
    {
        return $this->belongsToMany(User::class, 'job_users')->withTimestamps();
    }
}
