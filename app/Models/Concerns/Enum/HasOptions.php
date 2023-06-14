<?php

namespace App\Models\Concerns\Enum;

trait HasOptions
{
    /**
     * @return array<string, string>
     */
    public static function options(): array
    {
        return collect(self::cases())->mapWithKeys(function (self $case) {
            return [$case->value => $case->name];
        })->toArray();
    }
}
