<?php

namespace App\Http\Controllers\Image;

use App\Http\Controllers\Controller;
use App\Services\FileStorageService\FileStorageService;
use Illuminate\Http\Request;

class ImageController extends Controller
{
    public function __construct(
        public FileStorageService $fileStorageService
    ) {
    }
    public function __invoke($path)
    {
        return $this->fileStorageService->display($path);
    }
}
