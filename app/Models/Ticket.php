<?php

declare(strict_types=1);

namespace App\Models;

use App\Enums\TicketPriority;
use App\Enums\TicketStatus;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

final class Ticket extends Model
{
    use HasUuids, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $guarded = ['id'];

    public function customer(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function agent(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function attachments(): HasMany
    {
        return $this->hasMany(TicketAttachment::class);
    }

    public function isOpen(): bool
    {
        return $this->status === TicketStatus::OPEN->value;
    }

    public function isInProgress(): bool
    {
        return $this->status === TicketStatus::IN_PROGRESS->value;
    }

    public function isResolved(): bool
    {
        return $this->status === TicketStatus::RESOLVED->value;
    }

    public function isClosed(): bool
    {
        return $this->status === TicketStatus::CLOSED->value;
    }

    public function isLowPriority(): bool
    {
        return $this->priority === TicketPriority::LOW->value;
    }

    public function isMediumPriority(): bool
    {
        return $this->priority === TicketPriority::MEDIUM->value;
    }

    public function isHighPriority(): bool
    {
        return $this->priority === TicketPriority::HIGH->value;
    }

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'subject' => 'string',
            'description' => 'string',
            'user_id' => 'string',
            'agent_id' => 'string',
            'category_id' => 'string',
            'status' => TicketStatus::class,
            'priority' => TicketPriority::class,
            'resolved_at' => 'datetime',
            'closed_at' => 'datetime',
        ];
    }
}
