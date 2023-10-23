<?php 

declare(strict_types=1);

namespace App\Services\ApplyService;

use App\Events\NotificationEvent;
use App\Models\CV;
use App\Models\Job;
use App\Services\FileStorageService\FileStorageService;
use Illuminate\Support\Facades\Auth;

class Apply {
    public function __construct(
        public FileStorageService $fileStorageService
    )
    {
        
    }
    public function job_apply($request)
    {
        // return auth()->user();
        $position = Job::find($request->job_id);
        CV::create([
            "name"=>$request->name,
            "email"=>$request->email,
            "phone"=>$request->phone,
            "position"=>$request->position,
            "portfolio"=>$request->portfolio,
            "experiences"=>$request->experiences,
            "salary"=>$request->salary,
            "cv"=> $this->fileStorageService->upload(
                config('filesystems.folders.cv'),
                $request->cv,
            ),
            "user_id"=>auth()->id(),
            "job_id"=>$request->job_id
        ]);
        // return $request->job_id;
        $job = Job::find($request->job_id)->users()->attach(auth()->id());
        
        // return $job;
        event(new NotificationEvent(["user"=>auth()->user(),"job"=>$position]));

        return "Application Form is successfully sent";
    }

    public function get()
    {
        return CV::query()->get();
    }
}