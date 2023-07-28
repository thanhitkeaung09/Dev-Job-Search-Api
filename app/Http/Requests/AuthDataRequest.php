<?php

namespace App\Http\Requests;

use App\Dto\AuthData;
use Illuminate\Foundation\Http\FormRequest;

class AuthDataRequest extends FormRequest
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
            "social_id" => ["required"],
            "email" => ['required'],
            "password" => [],
            "cofirm_password" => []
        ];
    }

    public function payload(): AuthData
    {
        return AuthData::of([
            "name" => $this->name,
            "social_id" => $this->social_id,
            "email" => $this->email,
            "password" => $this->password,
            "confirm_password" => $this->confirm_password,
            "profile_image" => $this->profile_image
        ]);
    }
}
