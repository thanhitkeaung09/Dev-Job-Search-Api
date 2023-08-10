<?php

declare(strict_types=1);

namespace App\Dto;

use Illuminate\Http\UploadedFile;

class CompanyData implements Dto
{
    public function __construct(
        public string $name,
        public string $email,
        public string $hotline,
        public string $location,
        public UploadedFile $image,
        public string $website,
        public string $description
    ) {
    }

    public static function of($data): CompanyData
    {
        return new CompanyData(
            name: $data['name'],
            email: $data['email'],
            hotline: $data['hotline'],
            location: $data['location'],
            image: $data['image'],
            website: $data['website'],
            description: $data['description']
        );
    }

    public function toArray(): array
    {
        return [
            "name" => $this->name,
            "email" => $this->email,
            "hotline" => $this->hotline,
            "location" => $this->location,
            "image" => $this->image,
            "website" => $this->website,
            "description" => $this->description
        ];
    }
}
