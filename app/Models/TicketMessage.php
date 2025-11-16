<?php

declare(strict_types=1);

namespace App\Models;

use App\Enums\Roles;
use MongoDB\Laravel\Eloquent\Builder;
use MongoDB\Laravel\Eloquent\Model;

final class TicketMessage extends Model
{
    public $timestamps = true;

    protected $connection = 'mongodb';

    protected $collection = 'ticket_messages';

    protected $fillable = [
        'ticket_id',
        'sender_id',
        'role',
        'message',
    ];

    protected $casts = [
        'ticket_id' => 'string',
        'sender_id' => 'integer',
        'role' => Roles::class,
        'message' => 'string',
    ];

    public function scopeGetTicketMessages(Builder $query, Ticket $ticket): Builder
    {
        return $query->where('ticket_id', $ticket->id)
            ->orderBy('created_at', 'asc');
    }
}
