<?php

declare(strict_types=1);

namespace App\Dto;

class AdminData implements Dto
{
    public function __construct(
        public string $email,
        public string $password
    ) {
    }

    public static function of($data): AdminData
    {
        return new AdminData(
            email: $data['email'],
            password: $data['password']
        );
    }

    public function toArray(): array
    {
        return [
            'email' => $this->email,
            'password' => $this->password
        ];
    }
}
