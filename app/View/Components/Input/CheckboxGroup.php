<?php

namespace App\View\Components\Input;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class CheckboxGroup extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public string $name,
        public array $options,
        public bool $showAll = false,
        public ?string $model = '',
    )
    {
        //
    }

    public function optionsWithKeys()
    {
        return array_is_list($this->options) ? 
            array_combine($this->options, $this->options) :
            $this->options;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.input.checkbox-group');
    }
}
