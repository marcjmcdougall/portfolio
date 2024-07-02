<?php

namespace App\View\Components\Input;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class TextInput extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public ?string $type = 'text',
        public ?string $value = null,
        public ?string $name = null,
        public ?string $placeholder = null,
        public ?string $helpText = null,
        public ?string $model = null,
        public ?int $height = 200,
        public ?bool $disabled = false,
        public ?string $layout = 'block',
        public ?bool $clearable = false,
    )
    {
        
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.input.text-input');
    }
}
