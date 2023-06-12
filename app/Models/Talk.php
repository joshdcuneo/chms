<?php

namespace App\Models;

use App\Models\Concerns\TeamOwnedModel;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Talk extends TeamOwnedModel
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
        'team_id',
    ];

    /**
     * @var array<string, string>
     */
    protected $casts = [
        'audio_file' => 'json',
    ];

    public function series(): BelongsTo
    {
        return $this->belongsTo(Series::class);
    }

    public function speaker(): BelongsTo
    {
        return $this->belongsTo(Person::class);
    }
}
