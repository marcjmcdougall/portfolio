<?php

namespace App\View\Components\Input;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

use Illuminate\Support\Facades\Log;

class RangeInput extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public ?int $value = 50000,
        public ?string $name = null,
        public ?string $model = null,
    )
    {
        //
    }

    public function updated($value)
    {
        Log::info('Value updated: ' . $value);
        // Emit an event with the updated value
        $this->value = $value;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.input.range-input');
    }
}
