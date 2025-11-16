<?php

declare(strict_types=1);

namespace App\Policies;

use App\Models\Ticket;
use App\Models\User;

final class TicketPolicy
{
    public function view(User $user, Ticket $ticket): bool
    {
        if ($user->id === $ticket->user_id) {
            return true;
        }
        if ($user->id === $ticket->agent_id) {
            return true;
        }

        return $user->isAdmin();
    }
}
