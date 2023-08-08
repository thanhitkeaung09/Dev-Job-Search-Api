<?php

declare(strict_types=1);

namespace App\Dto;

use Illuminate\Http\UploadedFile;

class AdminJobData implements Dto
{
    public function __construct(
        public string $position,
        public string $shift,
        public string | null $user_id,
        public string $country,
        public string $job_description,
        public string $requirement,
        public string $responsibilities,
        public string $company,
        public UploadedFile $company_image,
        public string $company_website
    ) {
    }

    public static function of($data): AdminJobData
    {
        return new AdminJobData(
            position: $data['position'],
            shift: $data['shift'],
            user_id: $data['user_id'],
            country: $data['country'],
            job_description: $data['job_description'],
            requirement: $data['requirement'],
            responsibilities: $data['responsibilities'],
            company: $data['company'],
            company_image: $data['company_image'],
            company_website: $data['company_website']
        );
    }

    public function toArray(): array
    {
        return [
            "position" => $this->position,
            "shift" => $this->shift,
            "user_id" => $this->user_id,
            "country" => $this->country,
            "job_description" => $this->job_description,
            "requirement" => $this->requirement,
            "responsibilities" => $this->responsibilities,
            "company" => $this->company,
            "company_image" => $this->company_image,
            "company_website" => $this->company_website
        ];
    }
}
