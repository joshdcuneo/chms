<?php

namespace App\Providers;

use App\Models\CoreDemographic;
use App\Models\Event;
use App\Models\OtherDemographic;
use App\Models\Person;
use App\Models\Series;
use App\Models\Study;
use App\Models\Talk;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\ServiceProvider;

class ModelServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Model::preventAccessingMissingAttributes();
        Model::preventLazyLoading();
        Model::preventSilentlyDiscardingAttributes();
        Relation::enforceMorphMap([
            'event' => Event::class,
            'person' => Person::class,
            'user' => User::class,
            'core_demographic' => CoreDemographic::class,
            'other_demographic' => OtherDemographic::class,
            'talk' => Talk::class,
            'series' => Series::class,
            'study' => Study::class
        ]);
    }
}
