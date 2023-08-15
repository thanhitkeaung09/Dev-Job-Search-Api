<?php

namespace App\Http\Controllers;

use App\Services\ApplicantService\ApplicantService;
use Illuminate\Http\Request;

class AdminApplicantsApplicantsUserController extends Controller
{
    public function __construct(
        public ApplicantService $applicantService
    ) {
    }
    public function __invoke()
    {
        return $this->applicantService->applicant();
    }
}
