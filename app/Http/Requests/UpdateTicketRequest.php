<?php

declare(strict_types=1);

namespace App\Http\Requests;

use App\Enums\TicketPriority;
use App\Models\Ticket;
use App\Models\TicketAttachment;
use App\Models\User;
use Illuminate\Container\Attributes\CurrentUser;
use Illuminate\Container\Attributes\RouteParameter;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

final class UpdateTicketRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(
        #[CurrentUser()] User $user,
        #[RouteParameter('ticket')] Ticket $ticket
    ): bool {
        return $user->isAdmin() || $ticket->agent()->is($user) || $ticket->customer()->is($user);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'subject' => ['nullable', 'string'],
            'description' => ['nullable', 'string'],
            'category_id' => ['nullable', 'string', 'exists:categories,id'],
            'priority' => ['nullable', Rule::in(TicketPriority::cases())],
            'attachments' => ['nullable', 'array', 'max:'.TicketAttachment::ALLOWED_NUMBER_OF_ATTACHMENTS],
            'attachments.*' => ['file', 'mimes:png,jpg,jpeg,pdf,doc,docx,txt', 'max:10240'],
        ];
    }
}
