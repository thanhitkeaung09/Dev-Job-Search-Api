<?php

namespace App\Http\Controllers;

use App\Http\Requests\JobPostRequest;
use App\Http\Response\ApiSuccessResponse;
use App\Services\ApplyService\Apply;
use Illuminate\Http\Request;

class JobApplyController extends Controller
{
    public function __construct(
        public Apply $applyService
    )
    {
        
    }
    public function __invoke(JobPostRequest $request)
    {
        return new ApiSuccessResponse($this->applyService->job_apply($request->payload()));
    }

    public function get()
    {
        return new ApiSuccessResponse($this->applyService->get());
    }
}
