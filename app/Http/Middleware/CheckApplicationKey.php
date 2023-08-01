<?php

namespace App\Http\Middleware;

use App\Http\Response\ApiErrorResponse;
use App\Models\ApplicationKey;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckApplicationKey
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        $appId = $request->header('app-id');
        $appSecret = $request->header('app-secret');
        if (!($appId && $appSecret)) {
            return $this->unauthorizedResponse();
        }

        $appKey = ApplicationKey::query()->where('app-id', $appId)->where('app-secret', $appSecret)->first();

        if (!isset($appKey)) {
            return $this->unauthorizedResponse();
        }

        if ($appKey->obsoletd) {
            return $this->oudatedResponse();
        }
        return $next($request);
    }

    public function unauthorizedResponse(): ApiErrorResponse
    {
        return new ApiErrorResponse(
            message: __('Unauthorized'),
            error : "Unauthorization Error",
            status: Response::HTTP_UNAUTHORIZED
        );
    }

    private function oudatedResponse(): ApiErrorResponse
    {
        return new ApiErrorResponse(
            message: __('Outdated'),
            error : 'Upgrade Require Error',
            status: Response::HTTP_UPGRADE_REQUIRED
        );
    }
}
