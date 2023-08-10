<?php

declare(strict_types=1);

namespace App\Dto;

use Illuminate\Http\UploadedFile;

class AdminData implements Dto
{
    public function __construct(
        public string $name,
        public UploadedFile $image,
        public string $password
    ) {
    }

    public static function of($data): AdminData
    {
        return new AdminData(
            name: $data['name'],
            password: $data['password'],
            image: $data['image']
        );
    }

    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'password' => $this->password,
            'image' => $this->image
        ];
    }
}
