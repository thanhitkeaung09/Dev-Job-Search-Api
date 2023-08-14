<?php

declare(strict_types=1);

namespace App\Services\CompanyService;

use App\Http\Resources\CompanyResource;
use App\Http\Response\ApiErrorResponse;
use App\Http\Response\ApiSuccessResponse;
use App\Models\Company;
use App\Services\FileStorageService\FileStorageService;
use Illuminate\Http\Resources\Json\PaginatedResourceResponse;

class CompanyService
{
    public function __construct(
        public FileStorageService $fileStorageService
    ) {
    }
    public function get_company()
    {
        $company = Company::query()->latest()->paginate(5);
        return $company;
    }

    public function single($type)
    {
        $company = Company::find($type);
        if ($company) {
            return new ApiSuccessResponse($company);
        } else {
            return new ApiErrorResponse(
                success: false,
                message: 'Company Not Found',
                status: 401
            );
        }
    }

    public function delete($type)
    {
        $company = Company::find($type);
        if ($company) {
            $company->delete();
            return new ApiSuccessResponse("Company Deleted Successfully");
        } else {
            return new ApiErrorResponse(
                status: 401,
                message: 'Company Not Found',
                success: false
            );
        }
    }

    public function create($request)
    {
        $path = $this->fileStorageService->upload(
            config('filesystems.folders.cv'),
            $request->image,
        );
        Company::create(
            [
                "name" => $request->name,
                "email" => $request->email,
                'hotline' => $request->hotline,
                "location" => $request->location,
                'image' => $path,
                'website' => $request->website,
                'description' => $request->description
            ]
        );
        return new ApiSuccessResponse("Company is created successfully");
    }

    public function update($type, $request)
    {
        $company = Company::find($type);
        if ($company) {
            if($request->image){
                $path = $this->fileStorageService->upload(
                    config('filesystems.folders.cv'),
                    $request->image
                );
                $company->image = $path;
            }
            $company->name = $request->name;
            $company->email = $request->email;
            $company->hotline = $request->hotline;
            $company->location = $request->location;
            $company->website = $request->website;
            $company->description = $request->description;
            $company->update();
            return new ApiSuccessResponse('Company is updated successfully');
        } else {
            return new ApiErrorResponse(
                success: false,
                status: 401,
                message: "Company Not Found"
            );
        }
    }
}
