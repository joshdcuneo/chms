<?php

namespace App\Models\Scopes;

use App\Models\Concerns\TeamOwnedModel;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;

class CurrentTeamScope implements Scope
{
    /**
     * @param Builder<TeamOwnedModel> $builder
     * @param TeamOwnedModel $model
     */
    public function apply(Builder $builder, Model $model): void
    {
        $builder->where($model->getTable().'.team_id', '=', auth()->user()?->currentTeam?->getKey());
    }
}
