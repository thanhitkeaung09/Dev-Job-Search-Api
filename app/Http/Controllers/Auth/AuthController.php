<?php

namespace App\Http\Controllers\Auth;

// use ApiSuccessResponse;
use App\Http\Response\ApiSuccessResponse;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function register()
    {
        return new ApiSuccessResponse ("This is auth controller");
    }
}
