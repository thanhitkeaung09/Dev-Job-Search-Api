<?php

declare(strict_types=1);

namespace App\Services\ApplicantService;

use App\Http\Resources\ApplicantResource;
use App\Http\Response\ApiSuccessResponse;
use App\Models\User;
use Illuminate\Http\Resources\Json\PaginatedResourceResponse;

class ApplicantService
{
    public function applicant()
    {
        $users = User::has('jobs')->with('jobs')->withCount('jobs')->paginate(5);
        // return new ApiSuccessResponse(ApplicantResource::collection($users));
        return new PaginatedResourceResponse(ApplicantResource::collection($users));
    }
}
