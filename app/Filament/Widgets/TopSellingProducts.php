<?php

namespace App\Filament\Widgets;

use Filament\Widgets\Widget;
use App\Models\OrderItem;
use App\Models\Product;

class TopSellingProducts extends Widget
{
    protected static string $view = 'filament.widgets.top-selling-products';

    public $products;

    public function mount()
    {
        $this->products = Product::select('products.name')
            ->join('order_items', 'products.id', '=', 'order_items.product_id')
            ->selectRaw('products.name, SUM(order_items.quantity) as total_quantity')
            ->groupBy('products.name')
            ->orderByDesc('total_quantity')
            ->take(5)
            ->get();
    }
}
