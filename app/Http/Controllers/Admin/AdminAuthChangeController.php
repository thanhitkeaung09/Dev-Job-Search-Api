<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminDataRequest;
use App\Services\AdminService\AdminService;
use Illuminate\Http\Request;

class AdminAuthChangeController extends Controller
{
    public function __construct(
        public AdminService $adminService
    ) {
    }
    public function __invoke(AdminDataRequest $request)
    {
        return $this->adminService->update($request->payload());
    }

    public function profile()
    {
        return $this->adminService->profile();
    }
}
