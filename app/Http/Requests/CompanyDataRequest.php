<?php

namespace App\Http\Requests;

use App\Dto\CompanyData;
use Illuminate\Foundation\Http\FormRequest;

class CompanyDataRequest extends FormRequest
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
            "hotline" => ['required'],
            "location" => ['required'],
            "image" => ['required'],
            "website" => ['required'],
            "description" => ['required']
        ];
    }

    public function payload(): CompanyData
    {
        return CompanyData::of([
            "name" => $this->name,
            "email" => $this->email,
            "hotline" => $this->hotline,
            "location" => $this->location,
            "image" => $this->image,
            "website" => $this->website,
            "description" => $this->description
        ]);
    }
}
