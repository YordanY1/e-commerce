<?php

namespace App\Filament\Widgets;

use Filament\Widgets\Widget;
use App\Models\Order;
use App\Models\Customer;

class SalesOverview extends Widget
{
    protected static string $view = 'filament.widgets.sales-overview';

    public $totalSales;
    public $orderCount;
    public $customerCount;

    public function mount()
    {
        $this->totalSales = number_format(Order::sum('total_amount'), 2) . ' лв';
        $this->orderCount = Order::count();
        $this->customerCount = Customer::count();
    }
}
