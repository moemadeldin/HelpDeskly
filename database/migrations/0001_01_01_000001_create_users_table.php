<?php

declare(strict_types=1);

use App\Enums\ActivityStatus;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table): void {
            $table->uuid('id')->primary();
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('email')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('verification_code')->index()->nullable();
            $table->timestamp('verification_code_expire_at')->index()->nullable();
            $table->string('password')->nullable();
            $table->string('phone_number')->nullable();
            $table->string('avatar')->nullable();
            $table->foreignUuid('role_id')
                ->nullable()
                ->index()
                ->constrained('roles')
                ->restrictOnDelete();
            $table->boolean('is_active')
                ->index()
                ->default(true);
            $table->string('status')
                ->index()
                ->default(ActivityStatus::OFFLINE->value);
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('password_reset_tokens', function (Blueprint $table): void {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table): void {
            $table->string('id')->primary();
            $table->foreignUuId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }
};
