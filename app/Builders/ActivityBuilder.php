<?php

namespace App\Builders;

use App\Models\Activity;
use App\Models\Team;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;

/**
 * @extends Builder<Activity>
 */
class ActivityBuilder extends Builder
{
    public function forCurrentTeam(): self
    {
        return $this->whereHasMorph('causer', [User::class], function (Builder $builder) {
            $builder->whereIn('id', auth()->user()?->currentTeam?->allUsers()->pluck('id') ?? []);
        });
    }
}
