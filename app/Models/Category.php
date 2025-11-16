<?php

declare(strict_types=1);

namespace App\Models;

use App\Traits\Sluggable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

final class Category extends Model
{
    use HasUuids, Sluggable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $guarded = ['id'];

    public function tickets(): HasMany
    {
        return $this->hasMany(Ticket::class);
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function scopeGetCategories(Builder $query): Builder
    {
        return $query->select(['id', 'name', 'slug']);
    }

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'name' => 'string',
            'slug' => 'string',
        ];
    }
}
