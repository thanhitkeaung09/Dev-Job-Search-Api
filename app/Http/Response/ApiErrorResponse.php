<?php

declare(strict_types=1);

namespace App\Http\Response;

use Illuminate\Contracts\Support\Responsable;
use Illuminate\Http\Response as HttpResponse;
use Symfony\Component\HttpFoundation\Response;
use Throwable;

class ApiErrorResponse implements Responsable
{
    public function __construct(
        protected string $message = 'false',
        protected int $status = HttpResponse::HTTP_INTERNAL_SERVER_ERROR,
        protected array $headers = [],
        protected ?Throwable $e = null,
        protected mixed $data
    ) {
    }

    public function toResponse($request): Response
    {
        $response['message'] = $this->message;
        $response['status'] = $this->status;

        if ($this->e && config('app.debug')) {
            $response['debug'] = [
                'message' => $this->e->getMessage(),
                'file' => $this->e->getFile(),
                'line' => $this->e->getLine(),
                'trace' => $this->e->getTraceAsString(),
            ];
        }

        return response()->json(
            data: [
                'data' => $this->data,
                'message' => $this->message,
            ],
            status: $this->status,
            headers: $this->headers,
        );
    }
}
