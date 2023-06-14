<?php

namespace App\Models;

use App\Builders\EventBuilder;
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
        'end' => 'immutable_datetime',
    ];

    public function newEloquentBuilder($query): EventBuilder
    {
        return new EventBuilder($query);
    }

    /**
     * @return BelongsToMany<Person>
     */
    public function people(): BelongsToMany
    {
        return $this->belongsToMany(Person::class)
            ->withTimestamps();
    }

    /**
     * @return Attribute<EventStatus, void>
     */
    public function status(): Attribute
    {
        return new Attribute(fn() => $this->getStatus());

    }
    public function getStatus(): EventStatus
    {
        if ($this->start > now()) {
            return EventStatus::Upcoming;
        }

        if ($this->end < now()) {
            return EventStatus::Finished;
        }

        return EventStatus::Ongoing;
    }


}
