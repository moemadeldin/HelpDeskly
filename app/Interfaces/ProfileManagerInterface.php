<?php

declare(strict_types=1);

namespace App\Interfaces;

use App\DTOs\Auth\ProfileDTO;
use App\Models\User;
use Illuminate\Http\UploadedFile;

interface ProfileManagerInterface
{
    public function updateProfile(ProfileDTO $dto): User;

    public function updateAvatar(User $user, UploadedFile $avatar, ProfileDTO $dto): User;
}
