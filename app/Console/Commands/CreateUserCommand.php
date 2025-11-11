<?php

declare(strict_types=1);

namespace App\Console\Commands;

use App\Enums\Roles;
use App\Models\Role;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

final class CreateUserCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'users:create';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new user';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $user = $this->promptUserData();

        $roleName = $this->choice('Role of the new user', array_map(
            fn ($role): string => $role->value, Roles::cases()
        ), 1);
        $this->info("DEBUG: Role selected: $roleName");

        $this->validateUserData($user);

        $role = Role::where('name', $roleName)->firstOrFail();

        DB::transaction(function () use ($user, $role): void {
            $newUser = User::create([
                'first_name' => $user['first_name'],
                'last_name' => $user['last_name'],
                'phone_number' => $user['phone_number'],
                'email' => $user['email'],
                'password' => Hash::make($user['password']),
                'is_active' => true,
                'role_id' => $role->id,
                'email_verified_at' => now(),
            ]);
        });
        $this->info('User '.$user['email'].' created successfully');
    }

    private function promptUserData(): array
    {
        return [
            'first_name' => $this->ask('First Name of the new user?'),
            'last_name' => $this->ask('Last Name of the new user?'),
            'phone_number' => $this->ask('Phone Number of the new user?'),
            'email' => $this->ask('Email of the new user?'),
            'password' => $this->secret('Password of the new user?'),
        ];
    }

    private function validateUserData(array $data): void
    {
        Validator::make($data, [
            'first_name' => ['required', 'string'],
            'last_name' => ['required', 'string'],
            'phone_number' => ['nullable', 'string', 'unique:users,phone_number'],
            'email' => ['required', 'string', 'unique:users,email'],
            'password' => ['required', 'min:6', 'max:15'],
        ])->validate();
    }
}
