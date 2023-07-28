<?php

namespace App\Http\Controllers\OTP;

use App\Http\Controllers\Controller;
use App\Http\Response\ApiSuccessResponse;
use App\Services\OTPService\OTPService;
use Illuminate\Http\Request;

class OTPController extends Controller
{
    public function __construct(
        public OTPService $oTPService
    ) {
    }
    public function confirm(Request $request)
    {
        return new ApiSuccessResponse($this->oTPService->confirm($request));
    }

    public function resend(Request $request)
    {
        return new ApiSuccessResponse($this->oTPService->resend($request));
    }
}
