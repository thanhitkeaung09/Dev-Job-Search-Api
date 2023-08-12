<?php

namespace App\Http\Controllers\ForgetPassword;

use App\Http\Controllers\Controller;
use App\Http\Response\ApiSuccessResponse;
use App\Services\ForgetPasswordService\ForgetPasswordService;
use Illuminate\Http\Request;

class ForgetPasswordController extends Controller
{
    public function __construct(
        public ForgetPasswordService $forgetPasswordService
    )
    {
        
    }
    public function __invoke(Request $request)
    {
        return $this->forgetPasswordService->code_resend($request);        
    }

    public function confirm(Request $request)
    {
        return new ApiSuccessResponse($this->forgetPasswordService->confirm($request));
    }
    
}
