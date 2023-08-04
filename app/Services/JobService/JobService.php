<?php 

declare(strict_types=1);

namespace App\Services\JobService;

use App\Models\Job;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class JobService {
    public function search_jobs($request)
    {
        $query = Job::query();

    $data = $request->all();
    if (is_array($data)) {
        foreach ($data as $key => $value) {
            if ($value !== null) {
                $query->whereFindPositionOrCountryOrShift($key, $value);
            }
        }
    }

    $results = $query->paginate(12);
    return $results;
    }

    public function show_jobs()
    {
        $jobs = Job::query()->paginate(12);

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

    public function single_job($type){
        $job = Job::query()->find($type);

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

        return $job;
    }

}