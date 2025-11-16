<?php

declare(strict_types=1);

namespace App\Actions\Tickets;

use App\DTOs\Tickets\CreateTicketDTO;
use App\Models\Ticket;
use App\Models\User;

final readonly class CreateTicketAction
{
    public function handle(User $user, CreateTicketDTO $dto): Ticket
    {
        $ticket = $user->customerTickets()->create($dto->toArray());

        return $ticket;
    }
}
