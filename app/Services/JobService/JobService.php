<?php

declare(strict_types=1);

namespace App\Services\JobService;

use App\Http\Resources\JobResource;
use App\Http\Response\ApiErrorResponse;
use App\Http\Response\ApiSuccessResponse;
use App\Models\Job;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class JobService
{
    public function search_jobs($request)
    {
        $query = Job::with('company');

        $data = $request->all();
        if (is_array($data)) {
            foreach ($data as $key => $value) {
                if ($value !== null) {
                    $query->whereFindPositionOrCountryOrShift($key, $value);
                }
            }
        }

        $results = $query->get();
        return $results;
    }

    public function show_jobs()
    {
        // return Job::with('company')->get();
        $jobs = Job::with('company')->latest()->paginate(12);

        // Convert the "created_at" date for each job into "minutes ago", "hours ago", or "days ago"
        foreach ($jobs as $job) {
            $createdAt = Carbon::parse($job->created_at);
            $now = Carbon::now();

            $diffInSeconds = $createdAt->diffInSeconds($now);
            $diffInMinutes = $createdAt->diffInMinutes($now);
            $diffInHours = $createdAt->diffInHours($now);
            $diffInDays = $createdAt->diffInDays($now);

            if ($diffInSeconds < 60) {
                $job->timestamp = $diffInSeconds . " " . ($diffInSeconds === 1 ? "second ago" : "seconds ago");
            } elseif ($diffInMinutes < 60) {
                $job->timestamp = $diffInMinutes . " " . ($diffInMinutes === 1 ? "min ago" : "min ago");
            } elseif ($diffInHours < 24) {
                $job->timestamp = $diffInHours . " " . ($diffInHours === 1 ? "h ago" : "h ago");
            } else {
                $job->timestamp = $diffInDays . " " . ($diffInDays === 1 ? "d ago" : "d ago");
            }
        }

        return $jobs;
    }

    public function single_job($type)
    {
        $job = Job::with('company')->find($type);
        if ($job) {
            $createdAt = Carbon::parse($job->created_at);
            $now = Carbon::now();

            $diffInSeconds = $createdAt->diffInSeconds($now);
            $diffInMinutes = $createdAt->diffInMinutes($now);
            $diffInHours = $createdAt->diffInHours($now);
            $diffInDays = $createdAt->diffInDays($now);

            if ($diffInSeconds < 60) {
                $job->timestamp = $diffInSeconds . " " . ($diffInSeconds === 1 ? "second ago" : "seconds ago");
            } elseif ($diffInMinutes < 60) {
                $job->timestamp = $diffInMinutes . " " . ($diffInMinutes === 1 ? "min ago" : "min ago");
            } elseif ($diffInHours < 24) {
                $job->timestamp = $diffInHours . " " . ($diffInHours === 1 ? "h ago" : "h ago");
            } else {
                $job->timestamp = $diffInDays . " " . ($diffInDays === 1 ? "d ago" : "d ago");
            }

            return new ApiSuccessResponse($job);
        } else {
            return new ApiErrorResponse(
                status: 401,
                success: false,
                message: "Job Not Found"
            );
        }
    }
}
