<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class JobResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "id" => $this->id,
            "position" => $this->position,
            "shift" => $this->shift,
            "country" => $this->country,
            "job_description" => $this->job_description,
            "requirement" => $this->requirement,
            "responsibilities" => $this->responsibilities,
            "salary" => $this->salary,
            "created_at" => $this->created_at,
            "updated_at" => $this->updated_at,
            "company" => $this->company,
        ];
    }
}
