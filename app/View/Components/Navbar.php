<?php
namespace App\View\Components;

use App\Models\Category;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Log;
use Illuminate\View\Component;

class Navbar extends Component
{
    public $categories;

    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        // Get main categories with their children
        $this->categories = Category::whereNull('parent_id')->with('children')->get();

        Log::info('Categories with children', ['categories' => $this->categories->toArray()]);


    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.navbar', [
            'categories' => $this->categories
        ]);
    }
}
