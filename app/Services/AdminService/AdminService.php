<?php

declare(strict_types=1);

namespace App\Services\AdminService;

use App\Http\Resources\AdminResource;
use App\Http\Response\ApiErrorResponse;
use App\Http\Response\ApiSuccessResponse;
use App\Models\Admin;
use App\Services\AuthService\AuthService;
use App\Services\FileStorageService\FileStorageService;
use App\Services\SocialService\SocialService;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminService
{
    public function __construct(
        public SocialService $socialService,
        public AuthService $authService,
        public FileStorageService $fileStorageService
    ) {
    }
    public function login($request)
    {
        $admin = Admin::query()->where('email', $request->email)->first();
        $check = Hash::check($request->password, $admin->password);
        if ($check) {
            return ($this->socialService->generate($admin, $admin->email));
        }
    }

    public function logout()
    {
        return $this->authService->logout(Auth::user());
    }

    public function update($request)
    {
        $path = $this->fileStorageService->upload(
            config('filesystems.folders.cv'),
            $request->image
        );

        Auth::user()->update(
            [
                "name" => $request->name,
                'image' => $path,
                "password" => Hash::make($request->password)
            ]
        );
        return "Admin Update Successfully";
    }

    public function profile()
    {
        return new ApiSuccessResponse(new AdminResource(Auth::user()));
    }
}
