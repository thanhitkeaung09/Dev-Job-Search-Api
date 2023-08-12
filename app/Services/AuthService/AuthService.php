<?php

declare(strict_types=1);

namespace App\Services\AuthService;

use App\Mail\OTPSend;
use App\Models\Admin;
use App\Models\ForgetPassCode;
use App\Models\OTP;
use App\Models\User;
use App\Services\FileStorageService\FileStorageService;
use App\Services\SocialService\SocialService;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Throwable;

class AuthService
{
    public function __construct(
        public SocialService $socialService,
        public FileStorageService $fileStorageService,
    ) {
    }
    public function lgoin($request)
    {
        $user = $this->socialService->findBySocialId($request);
        if ($user) {
            $this->fileStorageService->update(
                $user->getRawOriginal('profile_image'),
                $request->profile_image
            );
        } else {
            $user = $this->socialService->create_user($request);
        }
        $this->socialService->generate($user, $user->social_id);
        return $user;
    }

    public function register($request)
    {
        $user = User::query()->where('email', $request->email)->first();
        
        $otp = $this->generate();
        $forgetExists = ForgetPassCode::query()->where('email',$request->email)->exists();
        $otpExists = OTP::query()->where('email',$request->email)->exists();
        $old_otp = OTP::query()->where("email", $request->email)->first();

        if($forgetExists || $otpExists){
            $old_otp->update(['otp' => $otp, "expired_at" => now()->addMinute()]);
        }
        else{
            $OTP = $this->Otp($request->email, $otp);
            ForgetPassCode::create(["email"=>$request->email,"otp"=>$otp, "expired_at" => now()->addMinute(30) ]);
        }
        Mail::to($request->email)->send(new OTPSend($request->name, $OTP));
        return "Email Sent";


        // ForgetPassCode::create(["email"=>$request->email,"otp"=>$otp, "expired_at" => now()->addMinute(30) ]);
        // Mail::to($request->email)->send(new OTPSend($request->name, $OTP));
        // return "Email Sent";
    }

    public function mail_login($request)
    {
        $user = User::query()->where("email", $request->email)->first();
        // if (Hash::check($request->password, $user->password)) {
            $this->socialService->generate($user, $user->email);
            return $user;
        // }
        // throw new Exception('Login Fail');
    }

    public function generate(): string
    {
        try {
            $number = random_int(
                min: 000_000,
                max: 999_999,
            );
        } catch (Throwable $exception) {
            throw new Exception('Failed to generate an OTP codes!');
        }

        return str_pad(
            string: strval($number),
            length: 6,
            pad_string: '0',
            pad_type: STR_PAD_LEFT,
        );
    }

    public function Otp($email, $otp)
    {
        return OTP::create([
            "email" => $email,
            "otp" => $otp,
            "expired_at" => now()->addMinute(),
        ]);
    }

    public function password_change($request)
    {
        $otp = ForgetPassCode::query()->where("otp", $request->code)->first();
        $user = User::query()->where('email', $request->email)->first();
        if ($otp && $otp->expired_at->greaterThan(now())) {

            if ($request->password === $request->new_password) {
            $user->update(["password" => Hash::make($request->password)]);
            $this->socialService->generate($user, $user->email);

            // Expire the OTP by setting expired_at to a past time (e.g., one second ago)
            $otp->expired_at = Carbon::now()->subSecond();
            $otp->save();
            
            return $user;
        } } else {
            throw new Exception("OTP Code is expired");
        }
    }

    public function logout(User | Admin $user)
    {
        $this->revoketoken($user);
        return "Logout Successfully";
    }

    public function revoketoken(User | Admin $user)
    {
        return $user->tokens()->delete();
    }

    public function profile()
    {
        return Auth::user();
    }
}
