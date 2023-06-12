<?php

namespace App\Models;

use App\Models\Concerns\TeamOwnedModel;
use App\Models\Event\EventStatus;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Event extends TeamOwnedModel
{
    use HasFactory;
    use HasUlids;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'team_id',
    ];

    /**
     * @var array<string, string>
     */
    protected $casts = [
        'start' => 'immutable_datetime',
        'end' => 'immutable_datetime'
    ];

    public function people(): BelongsToMany
    {
        return $this->belongsToMany(Person::class)
            ->withTimestamps();
    }

    public function status(): EventStatus
    {
        if ($this->end->isPast()) {
            return EventStatus::Finished;
        }

        if ($this->start->isFuture()) {
            return EventStatus::Upcoming;
        }

        return EventStatus::Ongoing;
    }

    public function scopeStatus(Builder $query, EventStatus $status): Builder
    {
        return match ($status) {
            EventStatus::Finished => $query->where('end', '<', now()),
            EventStatus::Upcoming => $query->where('start', '>', now()),
            EventStatus::Ongoing => $query->where('start', '<=', now())
                ->andWhere('end', '>=', now())
        };
    }
}
