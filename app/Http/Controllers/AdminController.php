<?php

namespace App\Http\Controllers;

use App\Http\Requests\AdminDataRequest;
use App\Http\Response\ApiSuccessResponse;
use App\Services\AdminService\AdminService;
use App\Services\AuthService\AuthService;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function __construct(
        public AdminService $adminService,
        public AuthService $authService
    ) {
    }
    public function __invoke(AdminDataRequest $adminDataRequest)
    {
        return new ApiSuccessResponse($this->adminService->login($adminDataRequest));
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
