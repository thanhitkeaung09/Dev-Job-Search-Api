<?php

declare(strict_types=1);

namespace App\Services\AdminService;

use App\Models\Admin;
use App\Services\AuthService\AuthService;
use App\Services\SocialService\SocialService;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminService
{
    public function __construct(
        public SocialService $socialService,
        public AuthService $authService
    ) {
    }
    public function login($adminDataRequest)
    {
        $admin = Admin::query()->where('email', $adminDataRequest->email)->first();
        $check = Hash::check($adminDataRequest->password, $admin->password);
        if ($check) {
            return $this->socialService->generate($admin, $admin->email);
        } else {
            throw new Exception('Login Fail');
        }
    }

    public function logout()
    {
        return $this->authService->logout(Auth::user());
    }
}
