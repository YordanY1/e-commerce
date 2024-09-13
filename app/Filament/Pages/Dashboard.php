<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;
use App\Filament\Widgets\SalesOverview;
use App\Filament\Widgets\OrdersChart;
use App\Filament\Widgets\RecentOrders;
use App\Filament\Widgets\TopSellingProducts;

class Dashboard extends Page
{
    protected static string $view = 'filament.pages.dashboard';
    protected static ?string $navigationIcon = 'heroicon-o-home';

    protected function getHeaderWidgets(): array
    {
        return [
            SalesOverview::class,
            TopSellingProducts::class,
            OrdersChart::class,
        ];
    }
}
