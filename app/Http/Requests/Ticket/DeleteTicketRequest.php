<?php

declare(strict_types=1);

namespace App\Http\Requests\Ticket;

use App\Models\Ticket;
use App\Models\User;
use Illuminate\Container\Attributes\CurrentUser;
use Illuminate\Container\Attributes\RouteParameter;
use Illuminate\Foundation\Http\FormRequest;

final class DeleteTicketRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(
        #[CurrentUser()] User $user,
        #[RouteParameter('ticket')] Ticket $ticket
    ): bool {
        return $user->isAdmin() || $ticket->customer()->is($user);
    }
}
