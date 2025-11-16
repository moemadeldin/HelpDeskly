<?php

declare(strict_types=1);

namespace App\Queries;

use App\Models\Ticket;
use App\Utilities\Constants;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

abstract class TicketQuery
{
    public function __construct(
        protected Request $request
    ) {}

    abstract protected function scope(): ?callable;

    final public function execute(): LengthAwarePaginator
    {
        return Ticket::with(['customer', 'agent'])
            ->when($this->scope(), fn (Builder $q): mixed => $this->scope()($q))
            ->filterCategory($this->request->safe()->category_id)
            ->filterPriority($this->request->safe()->priority)
            ->filterStatus($this->request->safe()->status)
            ->orderBy('created_at', 'desc')
            ->paginate(Constants::$NUMBER_OF_TICKETS)
            ->withQueryString();
    }
}
