<?php

declare(strict_types=1);

namespace App\Services\OTPService;

use App\Http\Response\ApiErrorResponse;
use App\Http\Response\ApiSuccessResponse;
use App\Models\OTP;
use App\Models\User;
use App\Services\AuthService\AuthService;
use App\Services\SocialService\SocialService;
use App\Mail\OTPSend;

use Exception;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class OTPService
{
    public function __construct(
        public SocialService $socialService,
        public AuthService $authService
    ) {
    }
    public function confirm($request)
    {
        $user = User::query()->where('email', $request->email)->first();
        if ($user) {
            return new ApiErrorResponse(
                message: 'User exists',
                status : 401,
                success: false
            );
        }
        else{
            User::create([
                "name" => $request->name,
                "email" => $request->email,
                "password" => Hash::make($request->password)
            ]);

            $otp = OTP::query()->where("otp", $request->code)->first();
            if ($otp && $otp->expired_at->greaterThan(now())) {
                $user = User::query()->where("email",$otp->email)->first();
                return new ApiSuccessResponse($this->socialService->generate($user, $otp->email));
            } else {
                return new ApiErrorResponse(
                    message: "OTP Code is expired",
                    status: 404,
                    success: false
                );
            }



        }
      

       
    }

    public function resend($request)
    {
        $otp = OTP::query()->where("email", $request->email)->first();
        if($otp){
            $new_otp = $this->authService->generate();
            $otp->update(['otp' => $new_otp, "expired_at" => now()->addMinute()]);
            Mail::to($otp->email)->send(new OtpSend("User", $otp));
            return new ApiSuccessResponse("OTP Code is resend");
        }
        else{
            return new ApiErrorResponse(
                message: "Email does not exists",
                success: false,
                status : 404
            );
        }       
    }
}
