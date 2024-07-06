<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use App\Models\Testimonial;

class Testimonials extends Component
{
    public $testimonials;
    public $showPhoto;
    public $showRole;

    /**
     * Create a new component instance.
     */
    public function __construct(
        $type = null, 
        $limit = null, 
        $showPhoto = false, 
        $showRole = false)
    {
        $query = Testimonial::orderBy('created_at', 'desc');

        if ( $type ) {
            $query->whereJsonContains('type', $type);
        }

        if ( $limit ) {
            $query->take( $limit );
        }

        $this->testimonials = $query->get();
        $this->showPhoto = $showPhoto;
        $this->showRole = $showRole;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.testimonials', ['testimonials' => $this->testimonials]);
    }
}
