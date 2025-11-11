<?php

declare(strict_types=1);

namespace App\DTOs;

use Illuminate\Http\UploadedFile;

final readonly class TicketDTO
{
    public function __construct(
        public string $subject,
        public string $description,
        public string $category,
        public string $password,
        public null|UploadedFile|string $attachment,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            $data['subject'],
            $data['description'],
            $data['category'],
            $data['password'],
            $data['attachment'] ?? null,
        );
    }

    public function toArray(): array
    {
        return [
            'subject' => $this->subject,
            'description' => $this->description,
            'category' => $this->category,
            'password' => $this->password,
            'attachment' => $this->attachment,
        ];
    }
}
