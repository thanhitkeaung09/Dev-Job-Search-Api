<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\ApplicantService\ApplicantService;
use App\Services\UserService\UserService;
use Illuminate\Http\Request;

class AdminUserController extends Controller
{
    public function __construct(
        public ApplicantService $applicantService,
        public UserService $userService
    ) {
    }
    public function __invoke()
    {
        return $this->userService->users();
    }
}
