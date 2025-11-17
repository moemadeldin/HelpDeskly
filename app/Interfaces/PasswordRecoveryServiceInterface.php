<?php

declare(strict_types=1);

namespace App\Interfaces;

use App\DTOs\Auth\ForgotPasswordDTO;
use App\DTOs\Auth\ResetPasswordDTO;
use App\Models\User;

interface PasswordRecoveryServiceInterface
{
    public function forgotPassword(ForgotPasswordDTO $dto): User;

    public function resetPassword(ResetPasswordDTO $dto): User;
}
