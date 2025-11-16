<?php

declare(strict_types=1);

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Enums\ActivityStatus;
use App\Enums\Roles;
use App\Utilities\Constants;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;

final class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, HasUuids, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $guarded = ['id'];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function isActive(): bool
    {
        return $this->is_active === true;
    }

    public function isAdmin(): bool
    {
        return $this->role->name === Roles::ADMIN->value;
    }

    public function isAgent(): bool
    {
        return $this->role->name === Roles::AGENT->value;
    }

    public function isCustomer(): bool
    {
        return $this->role->name === Roles::CUSTOMER->value;
    }

    public function isOnline(): bool
    {
        return $this->status === ActivityStatus::ONLINE->value;
    }

    public function isOffline(): bool
    {
        return $this->status === ActivityStatus::OFFLINE->value;
    }

    public function scopeGetUserByEmail(Builder $query, string $email): Builder
    {
        return $query->where('email', $email);
    }

    public function getFullNameAttribute(): string
    {
        return trim(ucwords($this->first_name.' '.$this->last_name));
    }

    public function role(): BelongsTo
    {
        return $this->belongsTo(Role::class);
    }

    public function customerTickets(): HasMany
    {
        return $this->hasMany(Ticket::class, 'user_id');
    }

    public function agentTickets(): HasMany
    {
        return $this->hasMany(Ticket::class, 'agent_id');
    }

    public function scopeAssignRandomAgent(Builder $query): Builder
    {
        $role = Role::where('name', Roles::AGENT->value)->value('id');

        return $query->where('role_id', $role)
            ->where('status', ActivityStatus::ONLINE->value)
            ->where(function ($q) {
                $q->whereHas('agentTickets', function ($subQuery) {
                    $subQuery->select(DB::raw('COUNT(*)'))
                        ->havingRaw('COUNT(*) < ?', [Constants::$MAX_AGENT_TICKETS]);
                }, '<', Constants::$MAX_AGENT_TICKETS)
                    ->orDoesntHave('agentTickets');
            });
    }

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'first_name' => 'string',
            'last_name' => 'string',
            'email' => 'string',
            'phone_number' => 'string',
            'avatar' => 'string',
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'is_active' => 'boolean',
            'verification_code' => 'string',
            'status' => ActivityStatus::class,
        ];
    }
}
