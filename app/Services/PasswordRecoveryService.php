<?php

declare(strict_types=1);

namespace App\Services;

use App\DTOs\Auth\ForgotPasswordDTO;
use App\DTOs\Auth\ResetPasswordDTO;
use App\Events\PasswordResetLinkCreated;
use App\Interfaces\PasswordRecoveryServiceInterface;
use App\Models\User;
use App\Notifications\PasswordChangedNotification;
use App\Utilities\Constants;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

final class PasswordRecoveryService implements PasswordRecoveryServiceInterface
{
    public function forgotPassword(ForgotPasswordDTO $dto): User
    {
        return DB::transaction(function () use ($dto): User {

            $user = User::getUserByEmail($dto->email)->first();

            $code = $this->generateRandomVerificationCode();
            $codeExpiration = $this->generateVerificationCodeExpireAt();
            $user->update([
                'verification_code' => $code,
                'verification_code_expire_at' => $codeExpiration,
            ]);
            event(new PasswordResetLinkCreated($user, $code, $codeExpiration));

            return $user;
        });
    }

    public function resetPassword(ResetPasswordDTO $dto): User
    {
        return DB::transaction(function () use ($dto): User {
            $user = User::getUserByEmail($dto->email)
                ->where('verification_code', $dto->verification_code)
                ->first();

            $user->update([
                'verification_code' => null,
                'verification_code_expire_at' => null,
                'password' => Hash::make($dto->new_password),
            ]);
            $user->notify(new PasswordChangedNotification($user));

            return $user;
        });
    }

    private function generateRandomVerificationCode(): int
    {
        return random_int(Constants::$MIN_VERIFICATION_CODE, Constants::$MAX_VERIFICATION_CODE);
    }

    private function generateVerificationCodeExpireAt(): Carbon
    {
        return Carbon::parse(now())->addMinutes(Constants::$VERIFICATION_CODE_TIME_EXPIRATION);
    }
}
