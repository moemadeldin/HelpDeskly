<?php

declare(strict_types=1);

namespace App\Actions;

use App\Enums\Roles;
use App\Events\MessageSent;
use App\Models\Ticket;
use App\Models\TicketMessage;
use Illuminate\Support\Facades\Auth;

final readonly class CreateTicketMessageAction
{
    public function handle(string $message, Ticket $ticket): TicketMessage
    {
        $message = TicketMessage::create([
            'ticket_id' => (string) $ticket->id,
            'sender_id' => Auth::id(),
            'role' => Auth::user()->isAgent() ? Roles::AGENT->value : Roles::CUSTOMER->value,
            'message' => $message,
            'is_seen' => false,
        ]);
        broadcast(new MessageSent($message))->toOthers();

        return $message;
    }
}
