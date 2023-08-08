<?php

namespace App\Http\Requests;

use App\Dto\LoginMailData;
use Illuminate\Foundation\Http\FormRequest;

class LoginMailRequest extends FormRequest
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
            "email" => ['required'],
            "password" => ['required']
        ];
    }
    public function payload(): LoginMailData
    {
        return LoginMailData::of([
            "email" => $this->email,
            "password" => $this->password
        ]);
    }
}
