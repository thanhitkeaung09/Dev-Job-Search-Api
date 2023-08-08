<?php

namespace App\Http\Requests;

use App\Dto\JobData;
use Illuminate\Foundation\Http\FormRequest;

class JobPostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            "name" => ['required'],
            "email" => ['required'],
            "phone" => ['required'],
            "position" => ['required'],
            "portfolio" => ['nullable'],
            "experiences" => ['nullable'],
            "salary" => ['nullable'],
            "cv" => ['required'],
            "user_id" => [''],
            "job_id" => ['required']
        ];
    }

    public function payload(): JobData
    {
        return JobData::of([
            "name"=>$this->name,
            "email" => $this->email,
            "phone" => $this->phone,
            "position" => $this->position,
            "portfolio" => $this->portfolio,
            "experiences" => $this->experiences,
            "salary" => $this->salary,
            "cv" => $this->cv,
            "user_id" => $this->user_id,
            "job_id" => $this->job_id
        ]
        );
    }
}
