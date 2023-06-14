<?php

namespace App\Models;

use App\Models\Concerns\TeamOwnedModel;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Person extends TeamOwnedModel
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
        'email',
        'phone',
        'team_id',
        'demographic_id',
    ];

    /**
     * @var array<int, string>
     */
    protected $with = ['team', 'coreDemographic'];

    /**
     * @return BelongsToMany<Event>
     */
    public function events(): BelongsToMany
    {
        return $this->belongsToMany(Event::class)
            ->withTimestamps();
    }

    /**
     * @return BelongsToMany<CoreDemographic>
     */
    public function otherDemographics(): BelongsToMany
    {
        return $this->belongsToMany(OtherDemographic::class)
            ->withTimestamps();
    }

    /**
     * @return BelongsTo<CoreDemographic>
     */
    public function coreDemographic(): BelongsTo
    {
        return $this->belongsTo(CoreDemographic::class);
    }
}
