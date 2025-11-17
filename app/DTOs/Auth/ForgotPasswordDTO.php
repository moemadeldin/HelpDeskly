<?php

declare(strict_types=1);

namespace App\DTOs\Auth;

final readonly class ForgotPasswordDTO
{
    public function __construct(
        public string $email,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            $data['email'],
        );
    }

    public function toArray(): array
    {
        return [
            'email' => $this->email,
        ];
    }
}
