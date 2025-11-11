<?php

declare(strict_types=1);

use App\Enums\TicketPriority;
use App\Enums\TicketStatus;
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
        Schema::create('tickets', function (Blueprint $table): void {
            $table->uuid('id')->primary();
            $table->string('subject')->nullable();
            $table->text('description')->nullable();
            $table->foreignUuid('user_id')
                ->nullable()
                ->index()
                ->constrained('users')
                ->nullOnDelete();
            $table->foreignUuid('agent_id')
                ->nullable()
                ->index()
                ->constrained('users')
                ->nullOnDelete();
            $table->foreignUuid('category_id')
                ->nullable()
                ->index()
                ->constrained('categories')
                ->nullOnDelete();
            $table->string('status')
                ->nullable()
                ->index()
                ->default(TicketStatus::OPEN->value);
            $table->string('priority')
                ->nullable()
                ->index()
                ->default(TicketPriority::MEDIUM->value);
            $table->timestamp('resolved_at')->nullable();
            $table->timestamp('closed_at')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
};
