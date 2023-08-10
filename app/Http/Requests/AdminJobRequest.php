<?php

namespace App\Http\Requests;

use App\Dto\AdminJobData;
use Illuminate\Foundation\Http\FormRequest;

class AdminJobRequest extends FormRequest
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
            "position" => ['required'],
            'shift' => ['required'],
            'user_id' => ['nullable'],
            'country' => ['required'],
            'job_description' => ['required'],
            'requirement' => ['required'],
            'responsibilities' => ['required'],
            'company_id' => ['required'],
            'salary' => ['required'],
            'candidates' => ['required']
        ];
    }

    public function payload(): AdminJobData
    {
        return AdminJobData::of([
            'position' => $this->position,
            'shift' => $this->shift,
            'user_id' => $this->user_id,
            'country' => $this->country,
            'job_description' => $this->job_description,
            'requirement' => $this->requirement,
            'responsibilities' => $this->responsibilities,
            'company_id' => $this->company_id,
            'salary' => $this->salary,
            'candidates' => $this->candidates
        ]);
    }
}
