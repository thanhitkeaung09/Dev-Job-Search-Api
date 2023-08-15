<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CompanyDataRequest;
use App\Http\Response\ApiSuccessResponse;
use App\Models\Company;
use App\Services\CompanyService\CompanyService;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    public function __construct(
        public CompanyService $companyService
    ) {
    }
    /**
     * All Companies
     */
    public function __invoke()
    {
        return $this->companyService->get_company();
    }
    /**
     * Single Company
     */
    public function single(string $type)
    {
        return $this->companyService->single($type);
    }
    /**
     * Delete
     */
    public function delete(string $type)
    {
        return $this->companyService->delete($type);
    }

    /**
     * Create Company
     */
    public function create(CompanyDataRequest $request)
    {
        return $this->companyService->create($request->payload());
    }
    /**
     * Company List including jobs , applicants and detail
     */
    public function company_list()
    {
        return new ApiSuccessResponse($this->companyService->company_list());
    }

    /**
     * Update Company
     */
    public function update(string $type, Request $request)
    {

        return $this->companyService->update($type, $request);
    }
    /**
     * DropDown
     */
    public function dropdown()
    {
        return $this->companyService->dropdown();
    }
}
