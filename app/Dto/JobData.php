<?php 

declare(strict_types=1);

namespace App\Dto;

use Illuminate\Http\UploadedFile;

class JobData implements Dto {
    public function __construct(
        public string $name,
        public string $email,
        public string $phone,
        public string $position,
        public string $portfolio,
        public string $experiences,
        public string $salary,
        public UploadedFile $cv,
        public string | null $user_id,
        public string $job_id
    )
    {
        
    }

    public static function of($data) : JobData
    {
        return new JobData(
            name : $data['name'],
            email : $data['email'],
            phone : $data['phone'],
            position : $data['position'],
            portfolio : $data['portfolio'],
            experiences : $data['experiences'],
            salary : $data['salary'],
            cv : $data['cv'],
            user_id :$data['user_id'],
            job_id : $data['job_id']
        );
    }

    public function toArray(): array
    {
        return [
            "name" => $this->name,
            "email" => $this->email,
            "phone" => $this->phone,
            "position" => $this->position,
            "portfolio" => $this->portfolio,
            "experiences" => $this->experiences,
            "salary" => $this->salary,
            "cv" => $this->cv,
            "user_id" => $this->user_id,
            "job" => $this->job_id
        ];
    }
}