<?php

declare(strict_types=1);

namespace App\Http\Controllers\Ticket;

use App\DTOs\Tickets\CreateTicketDTO;
use App\DTOs\Tickets\UpdateTicketDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\Ticket\DeleteTicketRequest;
use App\Http\Requests\Ticket\StoreTicketRequest;
use App\Http\Requests\Ticket\UpdateTicketRequest;
use App\Interfaces\TicketManagerInterface;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Container\Attributes\CurrentUser;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\RedirectResponse;

abstract class BaseTicketController extends Controller
{
    use AuthorizesRequests;

    public function __construct(private readonly TicketManagerInterface $ticketManager) {}

    final public function store(#[CurrentUser()] User $user, StoreTicketRequest $request): RedirectResponse
    {
        $this->ticketManager->create(CreateTicketDTO::fromArray($request->validated()), $user);

        return redirect()->route('tickets.index')->with('success', 'Ticket sent successfully!');
    }

    final public function update(UpdateTicketRequest $request, Ticket $ticket): RedirectResponse
    {
        $this->ticketManager->update(UpdateTicketDTO::fromArray($request->validated()), $ticket);

        return redirect($this->ticketManager->getRedirectRoute(auth()->user()))->with('success', 'Ticket updated successfully!');
    }

    final public function destroy(DeleteTicketRequest $request, Ticket $ticket): RedirectResponse
    {
        $this->ticketManager->destroy($ticket);

        return redirect()->route('tickets.index')->with('success', 'Ticket Deleted successfully!');
    }
}
