<?php

namespace App\Models\Concerns;

use App\Models\Scopes\CurrentTeamScope;
use App\Models\Team;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Http\Response;

/**
 * @property string $team_id
 * @property Team $team
 */
abstract class TeamOwnedModel extends Model
{
    /**
     * @var array<int, string>
     */
    protected $with = ['team'];
    protected static function boot(): void
    {
        parent::boot();

        static::creating(function (TeamOwnedModel $model): void {
            $model->team_id = auth()->user()->currentTeam->id;
        });

        static::updating(function(TeamOwnedModel $model): void {
            $model->mustBeOwnedByCurrentTeam();
        });

        static::deleting(function(TeamOwnedModel $model): void {
            $model->mustBeOwnedByCurrentTeam();
        });

        static::addGlobalScope(new CurrentTeamScope());
    }

    public function mustBeOwnedByCurrentTeam(): void
    {
        if($this->team_id !== auth()->user()->currentTeam->id) {
            abort(Response::HTTP_FORBIDDEN);
        }
    }

    /**
     * Get the team that owns the model.
     *
     * @return BelongsTo<Team>
     */
    public function team(): BelongsTo
    {
        return $this->belongsTo(Team::class);
    }
}
