<?php

namespace App\Filament\Widgets;

use Filament\Widgets\Widget;
use App\Models\Order;

class RecentOrders extends Widget
{
    protected static string $view = 'filament.widgets.recent-orders';

    public $orders;

    public function mount()
    {
        $this->orders = Order::with('customer')
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();
    }
}
