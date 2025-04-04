<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use App\Models\Brand;

class BrandsList extends Component
{
    public $brands;

    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        $query = Brand::orderBy('created_at', 'asc');
        $query->take( 5 ); // Limit to 6 brands at a time.

        $this->brands = $query->get();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.brands-list');
    }
}
