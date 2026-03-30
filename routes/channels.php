<?php

declare(strict_types=1);

use App\Models\Ticket;
use Illuminate\Support\Facades\Broadcast;
use Illuminate\Support\Facades\Log;

// Use custom middleware that doesn't require CSRF for Pusher
Broadcast::routes(['middleware' => ['web', 'broadcast.auth']]);

Broadcast::channel('ticket.{ticketId}', function ($user, $ticketId) {
    // If user is not authenticated, reject
    if (! $user) {
        Log::warning('Channel auth failed: user not authenticated');

        return false;
    }

    Log::info('Channel auth attempt', [
        'user_id' => $user->id,
        'ticket_id' => $ticketId,
    ]);

    $ticket = Ticket::find($ticketId);

    if (! $ticket) {
        Log::warning('Channel auth failed: ticket not found', ['ticket_id' => $ticketId]);

        return false;
    }

    if ($ticket->user_id === $user->id) {
        Log::info('Channel auth success: user is ticket owner');

        return true;
    }

    if ($ticket->agent_id === $user->id) {
        Log::info('Channel auth success: user is assigned agent');

        return true;
    }

    if ($user->isAdmin()) {
        Log::info('Channel auth success: user is admin');

        return true;
    }

    Log::warning('Channel auth failed: user has no access', [
        'user_id' => $user->id,
        'ticket_user_id' => $ticket->user_id,
        'ticket_agent_id' => $ticket->agent_id,
    ]);

    return false;
});
