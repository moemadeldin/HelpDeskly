<?php

declare(strict_types=1);

namespace App\Services;

use App\DTOs\Auth\ProfileDTO;
use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

final class ProfileManager
{
    public function updateProfile(ProfileDTO $dto): User
    {
        $user = Auth::user();

        $user->update($dto->toArray());

        return $user;
    }

    public function updateAvatar(User $user, UploadedFile $avatar, ProfileDTO $dto): User
    {
        return DB::transaction(function () use ($avatar, $dto, $user): User {
            $data = $dto->toArray();
            if ($avatar) {
                if ($user->avatar && Storage::disk('public')->exists($user->avatar)) {
                    Storage::disk('public')->delete($user->avatar);
                }
                $folderName = (string) str($data['first_name']);
                $data['avatar'] = $avatar->store("avatars/{$folderName}", 'public');
            }
            $user->update($data);

            return $user;
        });
    }
}
