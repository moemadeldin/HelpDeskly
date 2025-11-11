<?php

declare(strict_types=1);

namespace App\DTOs\Auth;

final readonly class RegisterDTO
{
    public function __construct(
        public string $first_name,
        public string $last_name,
        public string $email,
        public string $password,
        public ?string $phone_number,
        public ?string $avatar,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            $data['first_name'],
            $data['last_name'],
            $data['email'],
            $data['password'],
            $data['phone_number'] ?? null,
            $data['avatar'] ?? null,
        );
    }

    public function toArray(): array
    {
        return [
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'email' => $this->email,
            'password' => $this->password,
            'phone_number' => $this->phone_number ?? null,
            'avatar' => $this->avatar ?? null,
        ];
    }
}
