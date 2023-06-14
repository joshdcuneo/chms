<?php

namespace App\Builders;

use App\Models\Event;
use App\Models\Event\EventStatus;
use Illuminate\Database\Eloquent\Builder;

/**
 * @extends Builder<Event>
 */
class EventBuilder extends Builder
{
    public function status(EventStatus $status): self
    {
        return match ($status) {
            EventStatus::Finished => $this->where('end', '<', now()),
            EventStatus::Upcoming => $this->where('start', '>', now()),
            EventStatus::Ongoing => $this->where(function ($query) {
                return $query->where('start', '<=', now())->andWhere('end', '>=', now());
            })
        };
    }
}
