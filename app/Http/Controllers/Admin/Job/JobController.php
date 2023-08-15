<?php

namespace App\Http\Controllers\Admin\Job;

use App\Dto\AdminJobData;
use App\Http\Controllers\Controller;
use App\Http\Requests\AdminJobRequest;
use App\Http\Response\ApiSuccessResponse;
use App\Services\AdminService\JobService;
use Illuminate\Http\Request;

class JobController extends Controller
{
    public function __construct(
        public JobService $jobService
    ) {
    }
    public function __invoke(AdminJobRequest $request)
    {
        return new ApiSuccessResponse($this->jobService->create($request->payload()));
    }

    public function single(string $type)
    {
        return $this->jobService->single($type);
    }

    public function all()
    {
        return new ApiSuccessResponse($this->jobService->all());
    }
    public function delete(string $type)
    {
        return $this->jobService->delete($type);
    }
    public function update(string $type, AdminJobRequest $request)
    {
        return new ApiSuccessResponse($this->jobService->update($type, $request));
    }

    public function job_detail_list()
    {
        return $this->jobService->job_detail_list();
    }
}
