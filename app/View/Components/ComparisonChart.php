<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ComparisonChart extends Component
{
    public $columns;
    public $rows;
    public $values;


    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        $this->columns = [
            'My Approach', 
            'Employee', 
            'Contractor',
        ];

        $this->rows = [
            'World-class design', 
            'Total control over your project',
            'Results-driven design efforts', 
            'Quick & easy onboarding', 
            'No training & insurance costs', 
            'No long-term commitments',
        ];

        $this->values = [
            ['y', 'y', 'y'],
            ['y', 'y', 'y'],
            ['y', 'n', 'y'],
            ['y', '?', 'n'],
            ['y', 'n', '?'],
            ['y', 'n', 'y'],
        ];
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.comparison-chart');
    }
}
