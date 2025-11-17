<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Ticket\BaseTicketController;
use App\Http\Requests\FilterRequest;
use App\Models\Category;
use App\Models\Ticket;
use App\Models\TicketMessage;
use App\Queries\AdminTicketQuery;
use Illuminate\View\View;

final class TicketController extends BaseTicketController
{
    public function index(FilterRequest $request): View
    {
        return view('dashboard.admin.tickets.index', [
            'categories' => Category::getCategories()->get(),
            'tickets' => (new AdminTicketQuery($request))->execute(),
        ]);
    }

    public function show(Ticket $ticket): View
    {
        $this->authorize('view', $ticket);

        $messages = TicketMessage::getTicketMessages($ticket)->get();

        return view('dashboard.admin.tickets.show', [
            'ticket' => $ticket,
            'messages' => $messages,
        ]);
    }

    public function edit(Ticket $ticket): View
    {
        $categories = Category::getCategories()->get();

        return view('dashboard.admin.tickets.update', [
            'categories' => $categories,
            'ticket' => $ticket,
        ]);
    }
}
