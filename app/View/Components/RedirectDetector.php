<?php

namespace App\View\Components;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class RedirectDetector extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        $redirectedFrom = request()->query('ref');
        
        // Store in session if needed for later pages
        if ($redirectedFrom) {
            session(['redirected_from' => $redirectedFrom]);
        }
        
        return view('components.redirect-detector', [
            'redirectedFrom' => $redirectedFrom,
        ]);
    }
}
