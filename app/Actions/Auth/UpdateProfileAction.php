<?php

declare(strict_types=1);

namespace App\Actions\Auth;

use App\DTOs\Auth\UpdateProfileDTO;
use App\Models\User;

final readonly class UpdateProfileAction
{
    public function handle(UpdateProfileDTO $dto, User $user): User
    {
        $user->update(
            array_filter(
                $dto->toArray(),
                fn (?string $value): bool => $value !== null
            )
        );

        return $user;
    }
}
