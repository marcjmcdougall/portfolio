<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use App\Models\Article;

class Articles extends Component
{
    public $articles;

    /**
     * Create a new component instance.
     */
    public function __construct($limit = null)
    {
        $query = Article::orderBy('created_at', 'desc');

        if ( $limit ) {
            $query->take( $limit );
        }

        $this->articles = $query->get();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.articles');
    }
}
