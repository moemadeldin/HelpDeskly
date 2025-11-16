<?php

declare(strict_types=1);

namespace App\Actions\Tickets;

use App\Models\Ticket;

final readonly class DeleteTicketAction
{
    public function handle(Ticket $ticket): void
    {
        $ticket->delete();
    }
}
