<?php 

declare(strict_types=1);

namespace App\Builders;

use Illuminate\Database\Eloquent\Builder;

class JobBuilder extends Builder
{
    public function whereFindPositionOrCountryOrShift(string $key , string $value)
    {
        return $this->where($key,$value)  ; 
    }
}