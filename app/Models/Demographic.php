<?php

namespace App\Models;

use App\Models\Concerns\TeamOwnedModel;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Demographic extends TeamOwnedModel
{
    use HasFactory;
    use SoftDeletes;
    use HasUlids;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'description',
        'team_id',
    ];

    public function otherPeople(): BelongsToMany
    {
        return $this->belongsToMany(Person::class);
    }

    public function mainPeople(): HasMany
    {
        return $this->hasMany(Person::class, 'main_demographic_id');
    }
}
