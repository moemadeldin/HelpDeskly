<?php

declare(strict_types=1);

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\BaseTicketController;
use App\Http\Requests\FilterRequest;
use App\Models\Category;
use App\Models\Ticket;
use App\Models\TicketMessage;
use App\Models\User;
use App\Queries\UserTicketQuery;
use Illuminate\Container\Attributes\CurrentUser;
use Illuminate\View\View;

final class TicketController extends BaseTicketController
{
    public function index(FilterRequest $request, #[CurrentUser()] User $user): View
    {
        return view('customer.ticket.index', [
            'categories' => Category::getCategories()->get(),
            'tickets' => (new UserTicketQuery($request, $user))->execute(),
        ]);
    }

    public function create(): View
    {
        $categories = Category::getCategories()->get();

        return view('customer.ticket.create', [
            'categories' => $categories,
        ]);
    }

    public function show(Ticket $ticket): View
    {
        $this->authorize('view', $ticket);

        $messages = TicketMessage::getTicketMessages($ticket)->get();

        return view('customer.ticket.show', [
            'ticket' => $ticket,
            'messages' => $messages,
        ]);

    }

    public function edit(Ticket $ticket): View
    {
        $categories = Category::getCategories()->get();

        return view('customer.ticket.update', [
            'categories' => $categories,
            'ticket' => $ticket,
        ]);
    }
}
