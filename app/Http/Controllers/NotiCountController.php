<?php

namespace App\Http\Controllers;

use App\Http\Response\ApiSuccessResponse;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class NotiCountController extends Controller
{
    public function __invoke()
    {
        $count = DB::table('job_users')->where("is_read",false)->count();
        return new ApiSuccessResponse($count);
    }

    public function all(){
        $notification = User::with(['jobs' => function ($query) {
            $query->withPivot('is_read');
        }])->get();
    
        $modifiedNotifications = $notification->filter(function ($user) {
            return $user->jobs->isNotEmpty();
        })->map(function ($user) {
            $user->jobs->map(function ($job) {
                $job->is_read = $job->pivot->is_read;
                unset($job->pivot);
            });
    
            return $user;
        });
    
        return new ApiSuccessResponse($modifiedNotifications);
    }

    public function read(string $type){
        $noti = DB::table('job_users')->where("id",$type)->update(['is_read'=>1]);
        return new ApiSuccessResponse('Notification is read');

    }
}
