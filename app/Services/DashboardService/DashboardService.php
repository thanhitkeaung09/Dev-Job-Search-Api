<?php

declare(strict_types=1);

namespace App\Services\DashboardService;

use App\Http\Response\ApiSuccessResponse;
use App\Models\Company;
use App\Models\Job;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class DashboardService
{
    public function total()
    {
        $total = [
            "job_count" => Job::count(),
            "company_count" => Company::count(),
            "user_count" => User::count(),
            "applicants" => DB::table('job_users')->count()
        ];
        return new ApiSuccessResponse($total);
    }

    public function popular()
    {
        // return "pp";
        $counts = DB::table('job_users')->select('job_id', DB::raw('COUNT(*) as total'))->groupBy('job_id')->orderBy('total', 'DESC')->paginate(5);

        $jobs = [];
        foreach ($counts as $count) {
            $job = Job::withCount('users')->find($count->job_id);
            $jobs[] = $job;
        }
        return new ApiSuccessResponse($jobs);
    }
}
