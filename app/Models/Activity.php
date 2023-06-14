<?php

namespace App\Models;

use App\Builders\ActivityBuilder;
use Illuminate\Database\Eloquent\Concerns\HasUlids;

class Activity extends \Spatie\Activitylog\Models\Activity
{
    use HasUlids;

    public function newEloquentBuilder($query): ActivityBuilder
    {
        return new ActivityBuilder($query);
    }

}
