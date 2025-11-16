<?php

declare(strict_types=1);

namespace App\Interfaces;

use App\DTOs\Tickets\CreateTicketDTO;
use App\DTOs\Tickets\UpdateTicketDTO;
use App\Models\Ticket;
use App\Models\User;

interface TicketManagerInterface
{
    public function create(CreateTicketDTO $dto, User $user): Ticket;

    public function update(UpdateTicketDTO $dto, Ticket $ticket): Ticket;

    public function destroy(Ticket $ticket): void;

    public function getRedirectRoute(User $user): string;
}
