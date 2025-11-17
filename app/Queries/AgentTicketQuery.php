<?php

declare(strict_types=1);

namespace App\Queries;

use App\Enums\TicketStatus;
use App\Models\User;
use Illuminate\Http\Request;

final class AgentTicketQuery extends TicketQuery
{
    public function __construct(
        Request $request,
        private User $user
    ) {
        parent::__construct($request);
    }

    protected function scope(): ?callable
    {
        return fn ($q): mixed => $q->where('agent_id', $this->user->id)
            ->whereNotIn('status', [TicketStatus::CLOSED->value, TicketStatus::RESOLVED->value]);
    }
}
