<?php

declare(strict_types=1);

namespace App\Services\AdminService;

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
        $path = $this->fileStorageService->upload(
            config('filesystems.folders.cv'),
            $request->company_image
        );
        $job = Job::create([...$request->toArray(), 'company_image' => $path]);
        return $job;
    }

    public function single($type)
    {
        $job = Job::find($type);
        return $job;
    }

    public function all()
    {
        return Job::query()->get();
    }

    public function delete($type)
    {
        Job::query()->delete($type);
        return "Job is deleted successfully";
    }

    public function update($type, $request)
    {
        // return $request->payload();
        $path = $this->fileStorageService->upload(
            config('filesystems.folders.cv'),
            $request->company_image
        );
        $job = Job::find($type);
        $job->position = $request->position;
        $job->shift = $request->shift;
        $job->country = $request->country;
        $job->job_description = $request->job_description;
        $job->requirement = $request->requirement;
        $job->responsibilities = $request->responsibilities;
        $job->company = $request->company;
        $job->company_image = $path;
        $job->company_website = $request->company_website;
        $job->update();
        return "Job is updated successfully";
    }
}
