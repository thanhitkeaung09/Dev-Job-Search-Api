<?php

namespace App\Dto;

class AuthData implements Dto
{
    public function __construct(
        public string $name,
        public string $social_id,
        public string $email,
        public string $profile_image,
    ) {
    }

    public static function of($data): AuthData
    {
        return new AuthData(
            name: $data['name'],
            social_id: $data['social_id'],
            email: $data['email'],
            profile_image: $data['profile_image'],
        );
    }

    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'social_id' => $this->social_id,
            'email' => $this->email,
            'profile_image' => $this->profile_image
        ];
    }
}
