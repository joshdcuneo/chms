<?php

namespace App\Providers;

use Filament\Facades\Filament;
use Filament\Navigation\NavigationGroup;
use Filament\Navigation\UserMenuItem;
use Illuminate\Support\ServiceProvider;

class FilamentServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Filament::serving(function () {
            Filament::registerNavigationGroups([
                NavigationGroup::make()
                    ->label('People')
                    ->collapsed(),
                NavigationGroup::make()
                    ->label('Events')
                    ->collapsed(),
            ]);

            Filament::registerUserMenuItems([
                UserMenuItem::make()
                    ->label('Accounts Admin')
                    ->url(route('admin'))
                    ->icon('heroicon-s-cog'),
            ]);
        });
    }
}
