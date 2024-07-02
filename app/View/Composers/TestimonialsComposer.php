<?php

namespace App\View\Composers;

use Illuminate\View\View;
use App\Models\Testimonial;

class TestimonialsComposer
{
    /**
     * Includes the newsletter testimonials in every view.
     *
     * @param  \Illuminate\View\View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $testimonials = Testimonial::where('type', 'newsletter')->orderBy('created_at', 'desc')->get();
        $view->with('testimonials', $testimonials);
    }
}
