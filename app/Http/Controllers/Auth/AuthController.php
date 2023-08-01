<?php

namespace App\Http\Controllers\Auth;

// use ApiSuccessResponse;
use App\Http\Response\ApiSuccessResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\AuthDataRequest;
use App\Http\Requests\EmailRequest;
use App\Http\Requests\LoginMailRequest;
use App\Http\Response\ApiErrorResponse;
use App\Models\User;
use App\Services\AuthService\AuthService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{
    public function __construct(
        public AuthService $authService
    ) {
    }
    public function login(AuthDataRequest $request)
    {
        return new ApiSuccessResponse($this->authService->lgoin($request->payload()));
    }

    public function register(EmailRequest $emailRequest)
    {
        return new ApiSuccessResponse($this->authService->register($emailRequest->payload()));
    }

    public function mail_login(LoginMailRequest $request)
    {
        $user = User::query()->where("email", $request->payload()->email)->first();
        if (Hash::check($request->payload()->password, $user->password)) {
            return new ApiSuccessResponse($this->authService->mail_login($request->payload()));

        }
        else{
            return new ApiErrorResponse(
                error : "Login Fail",
                message: "false",
                status: 200
            );
        }
    }

    public function password_change(Request $request)
    {
        return new ApiSuccessResponse($this->authService->password_change($request));
    }

    public function logout()
    {
        return new ApiSuccessResponse($this->authService->logout(Auth::user()));
    }

    public function test()
    {
        return "this is auth test";
    }
}
