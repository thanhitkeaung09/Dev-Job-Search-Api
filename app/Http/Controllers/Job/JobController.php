<?php

namespace App\Http\Controllers\Job;

use App\Http\Controllers\Controller;
use App\Http\Response\ApiSuccessResponse;
use App\Services\JobService\JobService;
use Illuminate\Http\Request;

class JobController extends Controller
{
    public function __construct(
        public JobService $jobService
    )
    {

    }

    public function search_jobs(Request $request){
        return new ApiSuccessResponse($this->jobService->search_jobs($request));
    }

    public function show_jobs(){
        return new ApiSuccessResponse($this->jobService->show_jobs());
    }

    public function single_job(string $type){
        return new ApiSuccessResponse($this->jobService->single_job($type));
    }
}
