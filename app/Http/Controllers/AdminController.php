<?php

namespace App\Http\Controllers;

use App\Http\Response\ApiErrorResponse;
use App\Http\Response\ApiSuccessResponse;
use App\Models\Admin;
use App\Services\AdminService\AdminService;
use App\Services\AuthService\AuthService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function __construct(
        public AdminService $adminService,
        public AuthService $authService
    ) {
    }
    public function __invoke(Request $request)
    {
        $admin = Admin::query()->where('email', $request->email)->first();
        $check = Hash::check($request->password, $admin->password);
        if ($check) {
            return new ApiSuccessResponse($this->adminService->login($request));
        } else {
            return new ApiErrorResponse(
                success: false,
                status: 401,
                message: "Login Fail",
            );
        }
        // return new ApiSuccessResponse($this->adminService->login($request));
    }

    public function logout()
    {
        return new ApiSuccessResponse($this->adminService->logout());
    }

    public function test()
    {
        return "this is auth admin test";
    }
}
