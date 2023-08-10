<?php

declare(strict_types=1);

namespace App\Services\AdminService;

use App\Http\Response\ApiErrorResponse;
use App\Http\Response\ApiSuccessResponse;
use App\Models\Job;
use App\Services\FileStorageService\FileStorageService;

class JobService
{
    public function __construct(
        public FileStorageService $fileStorageService
    ) {
    }
    public function create($request)
    {
        $job = Job::create([...$request->toArray()]);
        return $job;
    }

    public function single($type)
    {
        $job = Job::with('company')->find($type);
        if ($job) {
            return new ApiSuccessResponse($job);
        } else {
            return new ApiErrorResponse(
                status: 401,
                success: false,
                message: "Job Not Found"
            );
        }
    }

    public function all()
    {
        return Job::with('company')->paginate(5);
    }

    public function delete($type)
    {
        $job = Job::find($type);
        if ($job) {
            $job->delete();
            return new ApiSuccessResponse('Job is deleted successfully');
        } else {
            return new ApiErrorResponse(
                status: 401,
                success: false,
                message: "Job Not Found"
            );
        }
    }

    public function update($type, $request)
    {
        $job = Job::find($type);
        $job->position = $request->position;
        $job->shift = $request->shift;
        $job->country = $request->country;
        $job->job_description = $request->job_description;
        $job->requirement = $request->requirement;
        $job->responsibilities = $request->responsibilities;
        $job->company_id = $request->company_id;
        $job->salary = $request->salary;
        $job->candidates = $request->candidates;
        //to start here
        $job->update();
        return "Job is updated successfully";
    }
}
