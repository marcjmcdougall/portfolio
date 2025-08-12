<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

use App\Models\Showcase;

class ShowcaseList extends Component
{
    public $row1Showcases;
    public $row2Showcases;

    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        // Single query to get both rows
        $showcases = Showcase::whereIn('row', [1, 2])
                            ->orderBy('row')
                            ->get()
                            ->groupBy('row');
        
        // Separate them into different collections
        $this->row1Showcases = $showcases->get(1, collect());
        $this->row2Showcases = $showcases->get(2, collect());

    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.showcase-list');
    }
}
