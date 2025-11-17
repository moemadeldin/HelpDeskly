<?php

declare(strict_types=1);

namespace App\Http\Controllers\Agent;

use App\Http\Controllers\Ticket\BaseTicketController;
use App\Http\Requests\FilterRequest;
use App\Models\Category;
use App\Models\Ticket;
use App\Models\TicketMessage;
use App\Models\User;
use App\Queries\AgentTicketQuery;
use Illuminate\Container\Attributes\CurrentUser;
use Illuminate\View\View;

final class TicketController extends BaseTicketController
{
    public function index(#[CurrentUser()] User $user, FilterRequest $request): View
    {
        return view('dashboard.agent.tickets.index', [
            'categories' => Category::getCategories()->get(),
            'tickets' => (new AgentTicketQuery($request, $user))->execute(),
        ]);
    }

    public function show(Ticket $ticket): View
    {
        $this->authorize('view', $ticket);

        $messages = TicketMessage::getTicketMessages($ticket)->get();

        return view('dashboard.agent.tickets.show', [
            'ticket' => $ticket,
            'messages' => $messages,
        ]);
    }

    public function edit(Ticket $ticket): View
    {
        return view('dashboard.agent.tickets.update', [
            'categories' => Category::getCategories()->get(),
            'ticket' => $ticket,
        ]);
    }
}
