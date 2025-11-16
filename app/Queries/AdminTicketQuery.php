<?php

declare(strict_types=1);

namespace App\Queries;

final class AdminTicketQuery extends TicketQuery
{
    protected function scope(): ?callable
    {
        return null;
    }
}
