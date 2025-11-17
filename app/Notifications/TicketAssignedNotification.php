<?php

declare(strict_types=1);

namespace App\Notifications;

use App\Models\Ticket;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

final class TicketAssignedNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct(public readonly Ticket $ticket) {}

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database', 'broadcast', 'mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('New Ticket Assigned - '.$this->ticket->subject)
            ->line('You have been assigned to a new ticket.')
            ->action('View Ticket', route('dashboard.agent.tickets.show', $this->ticket))
            ->line('Thank you for using our application!');
    }

    public function toDatabase(object $notifable): array
    {
        return [
            'ticket_id' => $this->ticket->id,
            'ticket_subject' => $this->ticket->subject,
            'message' => 'You have been assigned to a new ticket: '.$this->ticket->subject,
            'url' => route('dashboard.agent.tickets.show', $this->ticket),
        ];
    }

    public function toBroadcast(object $notifiable): BroadcastMessage
    {
        return new BroadcastMessage([
            'ticket_id' => $this->ticket->id,
            'ticket_subject' => $this->ticket->subject,
            'message' => 'You have been assigned to a new ticket: '.$this->ticket->subject,
            'url' => route('dashboard.agent.tickets.show', $this->ticket),
        ]);
    }
}
