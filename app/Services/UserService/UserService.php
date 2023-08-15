<?php

declare(strict_types=1);

namespace App\Services\UserService;

use App\Http\Resources\ApplicantResource;
use App\Http\Response\ApiSuccessResponse;
use App\Models\User;

class UserService
{
    public function users()
    {
        return ApplicantResource::collection(User::with('jobs')->withCount('jobs')->paginate(5));
    }

    public function dashboard_user()
    {
        $user = User::withCount('jobs')->paginate(5);
        return new ApiSuccessResponse($user);
    }
}
