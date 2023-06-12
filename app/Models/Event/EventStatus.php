<?php

namespace App\Models\Event;

use App\Models\Concerns\Enum\HasOptions;

enum EventStatus: string
{
    use HasOptions;
    case Finished = 'Finished';
    case Ongoing = 'Ongoing';
    case Upcoming = 'Upcoming';

}
