<?php

declare(strict_types=1);

namespace App\DTOs\Tickets;

final readonly class UpdateTicketDTO
{
    public function __construct(
        public ?string $subject,
        public ?string $description,
        public ?string $category_id,
        public ?string $priority,
        public ?array $attachments,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            $data['subject'],
            $data['description'],
            $data['category_id'],
            $data['priority'],
            array_key_exists('attachments', $data) ? $data['attachments'] : null
        );
    }

    public function toArray(): array
    {
        return [
            'subject' => $this->subject,
            'description' => $this->description,
            'category_id' => $this->category_id,
            'priority' => $this->priority,
        ];
    }
}
