<?php

namespace App\Http\Controllers\Admin\CV;

use App\Http\Controllers\Controller;
use App\Http\Response\ApiSuccessResponse;
use App\Services\AdminService\CVService;
use Illuminate\Http\Request;

class CVController extends Controller
{
    public function __construct(
        public CVService $cVService
    ) {
    }
    public function __invoke()
    {
        return new ApiSuccessResponse($this->cVService->get());
    }
}
