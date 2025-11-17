<?php

declare(strict_types=1);

namespace App\Http\Requests\Ticket;

use App\Models\Ticket;
use App\Models\User;
use Illuminate\Container\Attributes\CurrentUser;
use Illuminate\Container\Attributes\RouteParameter;
use Illuminate\Foundation\Http\FormRequest;

final class StoreMessageRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(
        #[CurrentUser()] User $user,
        #[RouteParameter('ticket')] Ticket $ticket
    ): bool {
        return $ticket->agent()->is($user) || $ticket->customer()->is($user);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'message' => ['required', 'string', 'max:1000'],
        ];
    }
}
