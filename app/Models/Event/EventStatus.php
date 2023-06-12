<?php

namespace App\Models\Event;
enum EventStatus: string
{
    case Finished = 'Finished';
    case Ongoing = 'Ongoing';
    case Upcoming = 'Upcoming';

    /**
     * @returns array<string, string>
     */
    public static function options(): array
    {
        return collect(self::cases())->mapWithKeys(function (self $case) {
            return [$case->value => $case->value];
        })->toArray();
    }
}
