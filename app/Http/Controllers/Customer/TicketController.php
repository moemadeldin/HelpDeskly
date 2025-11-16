<?php

declare(strict_types=1);

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\BaseTicketController;
use App\Http\Requests\FilterRequest;
use App\Models\Category;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Container\Attributes\CurrentUser;
use Illuminate\View\View;

final class TicketController extends BaseTicketController
{
    public function index(FilterRequest $request, #[CurrentUser()] User $user): View
    {
        $categories = Category::getCategories()->get();

        $tickets = Ticket::where('user_id', $user->id)
            ->with(['customer', 'agent'])
            ->filterCategory($request->safe()->category_id)
            ->filterPriority($request->safe()->priority)
            ->filterStatus($request->safe()->status)
            ->orderBy('created_at', 'desc')
            ->paginate(Ticket::NUMBER_OF_TICKETS)
            ->withQueryString();

        return view('customer.ticket.index', [
            'categories' => $categories,
            'tickets' => $tickets,
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
        return view('customer.ticket.show', [
            'ticket' => $ticket,
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
