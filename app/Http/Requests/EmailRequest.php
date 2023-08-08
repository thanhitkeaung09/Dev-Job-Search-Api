<?php

namespace App\Http\Requests;

use App\Dto\MailData;
use Illuminate\Foundation\Http\FormRequest;


class EmailRequest extends FormRequest
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
            "password" => ['required'],
            "confirm_password" => ['required']
        ];
    }

    public function payload(): MailData
    {
        return MailData::of([
            "name" => $this->name,
            "email" => $this->email,
            "password" => $this->password,
            "confirm_password" => $this->confirm_password
        ]);
    }
}
