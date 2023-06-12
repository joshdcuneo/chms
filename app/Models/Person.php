<?php

namespace App\Models;

use App\Models\Concerns\IsCategorizable;
use App\Models\Concerns\TeamOwnedModel;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
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
        'category_id',
        'demographic_id'
    ];

    /**
     * @var array<int, string>
     */
    protected $with = ['team', 'mainDemographic'];
    public function attendances(): HasMany
    {
        return $this->hasMany(Attendance::class);
    }

    public function events(): BelongsToMany
    {
        return app(Attendance::class)->joinsMany($this);
    }

    /**
     * @return BelongsToMany<Demographic>
     */
    public function otherDemographics(): BelongsToMany
    {
        return $this->belongsToMany(Demographic::class);
    }

    /**
     * @return BelongsTo<Demographic>
     */
    public function mainDemographic(): BelongsTo
    {
        return $this->belongsTo(Demographic::class);
    }
}
