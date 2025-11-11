<?php

declare(strict_types=1);

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
        Schema::create('ticket_attachments', function (Blueprint $table): void {
            $table->uuid('id')->primary();
            $table->string('path')->nullable();
            $table->foreignUuid('ticket_id')
                ->nullable()
                ->index()
                ->constrained('tickets')
                ->cascadeOnDelete();
            $table->uuidMorphs('attachable');
            $table->timestamps();
            $table->softDeletes();
        });
    }
};
