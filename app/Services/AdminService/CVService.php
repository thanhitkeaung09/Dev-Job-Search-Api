<?php

declare(strict_types=1);

namespace App\Services\AdminService;

use App\Http\Resources\UserResource;
use App\Models\Job;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class CVService
{
    public function get()
    {
        $users = UserResource::collection(User::withCount('jobs')->get());
        $count = User::with('jobs')->count();

        return [
            "count" => $count,
            "data" => $users
        ];
    }
}
