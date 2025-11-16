<?php

declare(strict_types=1);

namespace App\Services;

use App\DTOs\Tickets\CreateTicketDTO;
use App\DTOs\Tickets\UpdateTicketDTO;
use App\Interfaces\TicketManagerInterface;
use App\Models\Ticket;
use App\Models\TicketAttachment;
use App\Models\User;
use App\Utilities\Constants;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;

final class TicketManager implements TicketManagerInterface
{
    public function __construct(private readonly ImageManager $imageManager) {}

    public function create(CreateTicketDTO $dto, User $user): Ticket
    {
        return DB::transaction(function () use ($user, $dto): Ticket {

            $ticket = $user->customerTickets()->create($dto->toArray());

            if ($dto->attachments && count($dto->attachments) > 0) {
                $this->handleAttachments($dto->attachments, $ticket);
            }
            $this->assignAgent($ticket);

            return $ticket;
        });
    }

    public function update(UpdateTicketDTO $dto, Ticket $ticket): Ticket
    {
        return DB::transaction(function () use ($dto, $ticket): Ticket {

            $ticket->update($dto->toArray());
            if ($dto->attachments && count($dto->attachments) > 0) {
                $currCount = $ticket->attachments->count();
                $newCount = count($dto->attachments);
                $maxAllowed = Constants::$ALLOWED_NUMBER_OF_ATTACHMENTS - $currCount;

                if ($newCount > $maxAllowed) {
                    throw ValidationException::withMessages([
                        'attachments' => "You can only add {$maxAllowed} more attachments. Maximum is ".TicketAttachment::ALLOWED_NUMBER_OF_ATTACHMENTS.'.',
                    ]);
                }
                $this->handleAttachments($dto->attachments, $ticket);
            }

            return $ticket;
        });
    }

    public function destroy(Ticket $ticket): void
    {
        DB::transaction(function () use ($ticket): void {
            foreach ($ticket->attachments as $attachment) {
                Storage::disk('public')->delete($attachment->path);
            }
            $ticket->attachments()->delete();
            $ticket->delete();
        });
    }

    public function getRedirectRoute(User $user): string
    {
        if ($user->isAdmin()) {
            return route('dashboard.tickets.index');
        }
        if ($user->isAgent()) {
            return route('dashboard.agent.tickets.index');
        }

        return route('tickets.index');
    }

    private function handleAttachments(array $attachments, Ticket $ticket): void
    {
        $paths = $this->imageManager->uploadMultiple(
            $attachments,
            "tickets/{$ticket->id}/attachments"
        );
        foreach ($paths as $index => $path) {
            TicketAttachment::create([
                'path' => $path,
                'name' => $attachments[$index]->getClientOriginalName(),
                'size' => $attachments[$index]->getSize(),
                'type' => $attachments[$index]->getMimeType(),
                'ticket_id' => $ticket->id,
                'attachable_id' => $ticket->id,
                'attachable_type' => Ticket::class,
            ]);
        }
    }

    private function assignAgent(Ticket $ticket): void
    {
        $agent = User::assignRandomAgent()
            ->inRandomOrder()
            ->first();
        if ($agent) {
            $ticket->update(['agent_id' => $agent->id]);
        }
    }
}
