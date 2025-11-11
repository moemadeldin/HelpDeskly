<?php

declare(strict_types=1);

namespace App\Interfaces;

use App\DTOs\Auth\LoginDTO;
use App\DTOs\Auth\RegisterDTO;
use App\Models\User;

interface AuthServiceInterface
{
    public function register(RegisterDTO $dto): User;

    public function login(LoginDTO $dto): mixed;
}
