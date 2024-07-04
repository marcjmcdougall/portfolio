<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use App\Models\Question;

class Questions extends Component
{
    public $questions;

    /**
     * Create a new component instance.
     */
    public function __construct($topic = null)
    {
        $query = Question::orderBy('created_at', 'desc');

        if ( $topic ) {
            $query->whereJsonContains('topic', $topic);
        }

        $this->questions = $query->get();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.questions', ['questions' => $this->questions]);
    }
}
