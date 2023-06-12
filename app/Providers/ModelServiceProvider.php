<?php

namespace App\Providers;

use App\Models\Event;
use App\Models\Person;
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
            'user' => User::class
        ]);
    }
}
