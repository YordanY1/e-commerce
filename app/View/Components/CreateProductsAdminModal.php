<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\Contracts\View\View;
use Illuminate\Contracts\Support\Renderable;
use App\Models\Manufacturer;
use App\Models\Category;

class CreateProductsAdminModal extends Component
{
    public $manufacturers;

    public function __construct($manufacturers = null, $categories = null)
    {
        $this->manufacturers = $manufacturers ?? Manufacturer::all();
        $this->categories = $categories ?? Category::all();
    }

    public function render(): Renderable
    {
        return view('components.create-products-admin-modal', [
            'manufacturers' => $this->manufacturers,
            'categories' => $this->categories
        ]);
    }

}
