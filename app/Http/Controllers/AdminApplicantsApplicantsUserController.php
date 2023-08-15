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

    public function applicant_detail(string $type)
    {
        return $this->applicantService->applicant_detail($type);
    }

    public function applicant_user_detail()
    {
        return $this->applicantService->applicant_user_detail();
    }
}
