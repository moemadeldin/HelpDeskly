<?php

declare(strict_types=1);

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

final class UpdateProfileRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'first_name' => ['nullable', 'string'],
            'last_name' => ['nullable', 'string'],
            'email' => ['nullable', 'email', 'unique:users,email,'.auth()->id()],
            'phone_number' => ['nullable', 'digits:11', 'unique:users,phone_number,'.auth()->id()],
            'avatar' => ['nullable', 'image', 'mimes:png,jpg'],
        ];
    }
}
