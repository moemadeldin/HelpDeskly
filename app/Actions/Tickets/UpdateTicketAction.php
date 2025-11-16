<?php

declare(strict_types=1);

namespace App\Actions\Tickets;

use App\DTOs\Tickets\UpdateTicketDTO;
use App\Models\Ticket;

final readonly class UpdateTicketAction
{
    public function handle(UpdateTicketDTO $dto, Ticket $ticket): Ticket
    {
        $ticket->update(
            array_filter(
                $dto->toArray(),
                fn (?string $value): bool => $value !== null
            )
        );

        return $ticket;
    }
}
