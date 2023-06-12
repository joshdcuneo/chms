<?php

namespace App\Models;

use App\Models\Concerns\TeamOwnedModel;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Series extends TeamOwnedModel
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
        'image_file' => 'json',
    ];

    public function talks(): HasMany
    {
        return $this->hasMany(Talk::class);
    }

    public function studies(): HasMany
    {
        return $this->hasMany(Study::class);
    }
}
