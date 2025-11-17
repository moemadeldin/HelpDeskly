<?php

declare(strict_types=1);

namespace App\Http\Controllers\Ticket;

use App\Actions\CreateTicketMessageAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Ticket\StoreMessageRequest;
use App\Http\Resources\MessageResource;
use App\Models\Ticket;
use App\Models\TicketMessage;

final class TicketMessageController extends Controller
{
    public function show(Ticket $ticket): MessageResource
    {
        $this->authorize('view', $ticket);

        $messages = TicketMessage::getTicketMessages($ticket)->get();

        return new MessageResource($messages);
    }

    public function store(StoreMessageRequest $request, CreateTicketMessageAction $action, Ticket $ticket): MessageResource
    {
        $message = $action->handle($request->safe()->message, $ticket);

        return new MessageResource($message);
    }
}
