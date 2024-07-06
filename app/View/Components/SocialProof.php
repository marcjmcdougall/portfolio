<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use App\Models\Testimonial;

class SocialProof extends Component
{
    public $testimonials;

    /**
     * Create a new component instance.
     */
    public function __construct($type = null)
    {
        $query = Testimonial::orderBy('created_at', 'desc');
        $query->whereNotNull('profile_photo');

        if ( $type ) {
            $query->whereJsonContains('type', $type);
        }

        $this->testimonials = $query->take(4)->get();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.social-proof');
    }
}
