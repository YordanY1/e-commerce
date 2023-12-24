<?php

namespace App\View\Components;

use App\Models\Category;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class FilterModal extends Component
{
    public $categories;

    public function __construct()
    {
        $this->categories = Category::all();
    }

    public function render(): View
    {
        return view('components.filter-modal');
    }
}
