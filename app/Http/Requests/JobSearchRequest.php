<?php

namespace App\Http\Requests;

use App\Dto\JobSearchData;
use Illuminate\Foundation\Http\FormRequest;

class JobSearchRequest extends FormRequest
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
            "country" => ['required'],
            // "shift" => ['required']
        ];
    }

    public function payload(): JobSearchData
    {
        return JobSearchData::of([
            "position" => $this->position,
            "country" => $this->country,
            "shift" => $this->shift
        ]);
    }
}
