<?php

declare(strict_types=1);

namespace App\Dto;

class MailData implements Dto
{
    public function __construct(
        public string $name,
        public string $email,
        public string $password,
        public string $confirm_password
    ) {
    }

    public static function of($data): MailData
    {
        return new MailData(
            name: $data['name'],
            email: $data['email'],
            password: $data['password'],
            confirm_password: $data['confirm_password']
        );
    }

    public function toArray(): array
    {
        return [
            "name" => $this->name,
            "email" => $this->email,
            "password" => $this->password,
            "confirm_password" => $this->confirm_password
        ];
    }
}
