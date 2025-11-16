<?php

declare(strict_types=1);

namespace App\DTOs\Auth;

use Illuminate\Http\UploadedFile;

final readonly class UpdateProfileDTO
{
    public function __construct(
        public ?string $first_name,
        public ?string $last_name,
        public ?string $email,
        public ?string $phone_number,
        public ?UploadedFile $avatar,
    ) {}

    public static function fromArray(array|UploadedFile $data): self
    {
        return new self(
            $data['first_name'],
            $data['last_name'],
            $data['email'],
            $data['phone_number'],
            array_key_exists('avatar', $data) ? $data['avatar'] : null
        );
    }

    public function toArray(): array
    {
        return [
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'email' => $this->email,
            'phone_number' => $this->phone_number,
            'avatar' => $this->avatar,
        ];
    }
}
