<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\DashboardService\DashboardService;
use App\Services\UserService\UserService;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __construct(
        public UserService $userService,
        public DashboardService $dashboardService
    ) {
    }
    public function users()
    {
        return $this->userService->dashboard_user();
    }
    public function total()
    {
        return $this->dashboardService->total();
    }

    public function popular()
    {
        return $this->dashboardService->popular();
    }
}
