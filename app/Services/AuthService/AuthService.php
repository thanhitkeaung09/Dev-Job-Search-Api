<?php

declare(strict_types=1);

namespace App\Services\AuthService;

use App\Mail\OTPSend;
use App\Models\OTP;
use App\Models\User;
use App\Services\FileStorageService\FileStorageService;
use App\Services\SocialService\SocialService;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class AuthService
{
    public function __construct(
        public SocialService $socialService,
        public FileStorageService $fileStorageService
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
        if ($user) {
            throw new Exception('User exists');
        }
        $data = User::create([
            "name" => $request->name,
            "email" => $request->email,
            "password" => Hash::make($request->password)
        ]);
        $otp = $this->generate();
        $OTP = $this->Otp($data->email, $otp);
        Mail::to($data->email)->send(new OTPSend($data, $OTP));
        return "Email Sent";
    }

    public function mail_login($request)
    {
        $user = User::query()->where("email", $request->email)->first();
        if (Hash::check($request->password, $user->password)) {
            $this->socialService->generate($user, $user->email);
            return $user;
        }
        throw new Exception('Login Fail');
    }

    public function generate(): string
    {
        try {
            $number = random_int(
                min: 000_000,
                max: 999_999,
            );
        } catch (Throwable $exception) {
            throw new OtpGenerationException('Failed to generate an OTP codes!');
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
        $user = User::query()->where('email', $request->email)->first();
        if ($request->password === $request->new_password) {
            $user->update(["password" => Hash::make($request->password)]);
            return $this->socialService->generate($user, $user->email);
        } else {
            throw new Exception('Password does not match');
        }
    }

    public function logout($user)
    {
        $this->revoketoken($user);
        return "Logout Successfully";
    }

    public function revoketoken(User | Admin $user)
    {
        return $user->tokens()->delete();
    }
}
