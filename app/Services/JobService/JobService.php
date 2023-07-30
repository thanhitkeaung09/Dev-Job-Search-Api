<?php 

declare(strict_types=1);

namespace App\Services\JobService;

use App\Models\Job;
use Illuminate\Support\Facades\DB;

class JobService {
    public function search_jobs($request)
    {
        $query = DB::table('jobs');

    $data = $request->all();
    if (is_array($data)) {
        foreach ($data as $key => $value) {
            if ($value !== null) {
                $query->where($key, $value);
            }
        }
    }

    $results = $query->paginate(12);
    return $results;
    }

    public function show_jobs()
    {
        return Job::query()->paginate(12);
    }

    public function single_job($type){
        $job = Job::query()->find($type);
        return $job;
    }

}