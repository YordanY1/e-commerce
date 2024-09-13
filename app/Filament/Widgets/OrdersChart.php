<?php

namespace App\Filament\Widgets;

use Filament\Widgets\LineChartWidget;
use App\Models\Order;
use Carbon\Carbon;

class OrdersChart extends LineChartWidget
{
    protected static ?string $heading = 'Поръчки за последните 7 дни';

    protected function getData(): array
    {
        $dates = collect();
        $orders = collect();

        for ($i = 6; $i >= 0; $i--) {
            $date = Carbon::today()->subDays($i);
            $dates->push($date->format('d.m'));
            $orders->push(Order::whereDate('created_at', $date)->count());
        }

        return [
            'datasets' => [
                [
                    'label' => 'Поръчки',
                    'data' => $orders,
                    'borderColor' => '#4F46E5',
                    'backgroundColor' => 'rgba(79, 70, 229, 0.2)',
                ],
            ],
            'labels' => $dates,
        ];
    }
}
