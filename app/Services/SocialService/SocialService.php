<?php

declare(strict_types=1);

namespace App\Services\SocialService;

use App\Models\OTP;
use App\Models\User;
use App\Services\FileStorageService\FileStorageService;
use Exception;
use Illuminate\Support\Facades\Hash;

class SocialService
{
    public function __construct(
        public FileStorageService $fileStorageService
    ) {
    }
    public function findBySocialId($request)
    {
        return User::query()->where('social_id', $request->social_id)->where('email', $request->email)->first();
    }
    public function create_user($request)
    {
        $user = User::query()->where('email', $request->email)->exists();
        if (!$user) {
            if ($request->password === $request->confirm_password) {
                $path = $this->fileStorageService->put(
                    config('filesystems.folders.dev_profiles'),
                    $request->profile_image,
                );
                $user = User::create([
                    "name" => $request->name,
                    "social_id" => $request->social_id,
                    "email" => $request->email,
                    "password" => Hash::make($request->password),
                    "profile_image" => $path
                ]);
            } else {
                throw new Exception('Password does not match');
            }
        } else {
            throw new Exception('User Not Found');
        }
        return $user;
    }

    public function generate(User | Admin | OTP $model, string $unique)
    {
        return tap($model, function ($model) use ($unique) {
            $model->token = $model->createToken($unique)->plainTextToken;
        });
    }
}
