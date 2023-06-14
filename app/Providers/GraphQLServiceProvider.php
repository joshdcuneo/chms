<?php

namespace App\Providers;

use App\GraphQL\Resolvers\DefaultResolver;
use App\Models\Event\EventStatus;
use GraphQL\Executor\Executor;
use GraphQL\Type\Definition\PhpEnumType;
use Illuminate\Support\ServiceProvider;
use Nuwave\Lighthouse\Schema\TypeRegistry;

class GraphQLServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Executor::setDefaultFieldResolver(new DefaultResolver());
    }
}
