<?php

declare(strict_types=1);

namespace App\Services\OTPService;

use App\Models\OTP;
use App\Models\User;
use App\Services\AuthService\AuthService;
use App\Services\SocialService\SocialService;
use App\Mail\OTPSend;

use Exception;
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
        $otp = OTP::query()->where("otp", $request->code)->first();
        if ($otp && $otp->expired_at->greaterThan(now())) {
            $user = User::query()->where("email",$otp->email)->first();
            return $this->socialService->generate($user, $otp->email);
        } else {
            throw new Exception("OTP Code is expired");
        }
    }

    public function resend($request)
    {
        $otp = OTP::query()->where("email", $request->email)->first();
        $user = User::query()->where('email', $otp->email)->first();
        $new_otp = $this->authService->generate();
        $otp->update(['otp' => $new_otp, "expired_at" => now()->addMinute()]);
        Mail::to($otp->email)->send(new OtpSend($user, $otp));
        return "OTP Code is resend";
    }
}
