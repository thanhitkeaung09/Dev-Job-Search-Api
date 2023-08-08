<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use App\Http\Response\ApiSuccessResponse;
use App\Services\AuthService\AuthService;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function __construct(
        public AuthService $authService
    ) {
    }
    public function __invoke()
    {
        return new ApiSuccessResponse($this->authService->profile());
    }
}
