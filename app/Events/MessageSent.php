<?php

declare(strict_types=1);

namespace App\Events;

use App\Models\TicketMessage;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

final class MessageSent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public function __construct(
        public TicketMessage $message
    ) {}

    public function broadcastOn(): PrivateChannel
    {
        return new PrivateChannel('ticket.'.$this->message->ticket_id);
    }

    public function broadcastAs(): string
    {
        return 'message.sent';
    }

    public function broadcastWith(): array
    {
        return [
            'message' => [
                'id' => (string) $this->message->_id,
                'ticket_id' => $this->message->ticket_id,
                'sender_id' => $this->message->sender_id,
                'role' => $this->message->role->value,
                'message' => $this->message->message,
                'is_seen' => $this->message->is_seen,
                'created_at' => $this->message->created_at->toISOString(),
            ],
        ];
    }
}
