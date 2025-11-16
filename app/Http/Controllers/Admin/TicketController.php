<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseTicketController;
use App\Http\Requests\FilterRequest;
use App\Models\Category;
use App\Models\Ticket;
use Illuminate\View\View;

final class TicketController extends BaseTicketController
{
    public function index(FilterRequest $request): View
    {
        $categories = Category::getCategories()->get();
        // dd($categories);
        $tickets = Ticket::with(['customer', 'agent'])
            ->filterCategory($request->safe()->category_id)
            ->filterPriority($request->safe()->priority)
            ->filterStatus($request->safe()->status)
            ->orderBy('created_at', 'desc')
            ->paginate(Ticket::NUMBER_OF_TICKETS)
            ->withQueryString();

        return view('dashboard.tickets.index', [
            'categories' => $categories,
            'tickets' => $tickets,
        ]);
    }

    public function show(Ticket $ticket): View
    {
        return view('dashboard.tickets.show', [
            'ticket' => $ticket,
        ]);
    }

    public function edit(Ticket $ticket): View
    {
        $categories = Category::getCategories()->get();

        return view('dashboard.tickets.update', [
            'categories' => $categories,
            'ticket' => $ticket,
        ]);
    }
}
