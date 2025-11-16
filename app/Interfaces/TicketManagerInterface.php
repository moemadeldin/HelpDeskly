<?php

declare(strict_types=1);

namespace App\Interfaces;

use App\DTOs\Tickets\CreateTicketDTO;
use App\Models\Ticket;
use App\Models\User;

interface TicketManagerInterface
{
    public function create(CreateTicketDTO $dto, User $user): Ticket;

    // public function update(): Ticket;

    // public function destroy(): void;
}
