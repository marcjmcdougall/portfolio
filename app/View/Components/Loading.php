<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Loading extends Component
{
    // In your component class
    public $delay;
    public $classes;

    // In the constructor
    public function __construct(
        $delay = 0,
        $classes = '',
    )
    {
        $this->delay = $delay;
        $this->classes = $classes;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.loading');
    }
}
