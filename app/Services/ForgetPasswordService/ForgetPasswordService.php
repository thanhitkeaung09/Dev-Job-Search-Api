<?php 

declare(strict_types=1);

namespace App\Services\ForgetPasswordService;

use App\Mail\ForgetMailOTP;
use App\Models\ForgetPassCode;
use App\Models\User;
use App\Services\AuthService\AuthService;
use App\Services\SocialService\SocialService;
use Exception;
use Illuminate\Support\Facades\Mail;


class ForgetPasswordService
{
    public function __construct(
        public AuthService $authService,
        public SocialService $socialService
    )
    {
        
    }
    public function code_resend($request)
    {
        $otp = ForgetPassCode::query()->where("email", $request->email)->first();
        $user = User::query()->where('email', $otp->email)->first();
        $new_otp = $this->authService->generate();
        $otp->update(['otp' => $new_otp, "expired_at" => now()->addMinute(30)]);
        Mail::to($request->email)->send(new ForgetMailOTP($user,$otp));
        return "Forget password reset otp is successfully sent";
    }

    public function confirm($request)
    {
        // return $request->code;
        $otp = ForgetPassCode::query()->where("otp", $request->code)->first();
        if ($otp && $otp->expired_at->greaterThan(now())) {
            $user = User::query()->where("email",$otp->email)->first();
            return $this->socialService->generate($user, $otp->email);
        } else {
            throw new Exception("OTP Code is expired");
        }
    }
}