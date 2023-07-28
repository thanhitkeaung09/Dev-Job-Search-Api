<?php

namespace App\Dto;

class AuthData implements Dto
{
    public function __construct(
        public string $name,
        public string $social_id,
        public string $email,
        public string $password,
        public string $profile_image,
        public string | null  $confirm_password,
    ) {
    }

    public static function of($data): AuthData
    {
        return new AuthData(
            name: $data['name'],
            social_id: $data['social_id'],
            email: $data['email'],
            password: $data['password'],
            profile_image: $data['profile_image'],
            confirm_password: $data['confirm_password']
        );
    }

    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'social_id' => $this->social_id,
            'email' => $this->email,
            'password' => $this->password,
            'confirm_password' => $this->confirm_password,
            'profile_image' => $this->profile_image
        ];
    }
}
