<?php

namespace App\View\Components\Partials;

use Illuminate\View\Component;

class Button extends Component
{
    public $type;
    public $label;
    public $size;
    public $class;
    public $isLabelButton;

    public function __construct($type = 'primary', $label = 'Button', $size = 'sm', $class = '', $isLabelButton = false)
    {
        $this->type = $type;
        $this->label = $label;
        $this->size = $size;
        $this->class = $class;
        $this->isLabelButton = $isLabelButton;
    }

    public function render()
    {
        return view('components.partials.button');
    }
}
