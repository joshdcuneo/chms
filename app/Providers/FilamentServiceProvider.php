<?php

namespace App\Providers;

use Filament\Facades\Filament;
use Filament\Navigation\NavigationGroup;
use Filament\Navigation\NavigationItem;
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
            $this->registerUserMenuItems();
            $this->registerNavigationGroups();
            $this->registerNavigationItems();
        });
    }

    private function registerUserMenuItems(): void
    {
        Filament::registerUserMenuItems([
            UserMenuItem::make()
                ->label('Accounts Admin')
                ->url(route('admin'))
                ->icon('heroicon-s-cog'),
        ]);
    }

    private function registerNavigationGroups(): void
    {
        Filament::registerNavigationGroups([
            NavigationGroup::make()
                ->label('People')
                ->collapsed(),
            NavigationGroup::make()
                ->label('Events')
                ->collapsed(),
            NavigationGroup::make()
                ->label('Teaching')
                ->collapsed(),
            NavigationGroup::make()
                ->label('Developers')
                ->collapsed(),
        ]);
    }

    private function registerNavigationItems(): void
    {
        Filament::registerNavigationItems([
            NavigationItem::make('API')
                ->url(route('graphiql'), shouldOpenInNewTab: true)
                ->icon('heroicon-o-presentation-chart-line')
                ->group('Developers'),
        ]);
    }
}
