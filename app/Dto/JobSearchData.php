<?php 

declare(strict_types=1);

namespace App\Dto;

class JobSearchData implements Dto {
    public function __construct(
        public string $position,
        public string $country,
        public bool $shift
    )
    {
        
    }

    public static function of($data){
        return new JobSearchData(
            position : $data['position'],
            country : $data['country'],
            shift: $data['shift']
        );
    }

    public function toArray(): array
    {
        return [
            "position" => $this->position,
            "country" => $this->country,
            "shift" => $this->shift
        ];
    }
}