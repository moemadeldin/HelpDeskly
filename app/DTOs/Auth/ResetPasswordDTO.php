<?php

declare(strict_types=1);

namespace App\DTOs\Auth;

final readonly class ResetPasswordDTO
{
    public function __construct(
        public string $email,
        public string $new_password,
        public string $verification_code,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            email: $data['email'],
            new_password: $data['new_password'],
            verification_code: $data['verification_code'],
        );
    }

    public function toArray(): array
    {
        return [
            'email' => $this->email,
            'password' => $this->new_password,
            'verification_code' => $this->verification_code,
        ];
    }
}
