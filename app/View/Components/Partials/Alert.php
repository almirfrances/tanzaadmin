<?php

namespace App\View\Components\Partials;

use Illuminate\View\Component;

class Alert extends Component
{
    public $type;
    public $message;
    public $dismissible;

    /**
     * Create a new component instance.
     *
     * @param  string  $type
     * @param  string  $message
     * @param  bool  $dismissible
     * @return void
     */
    public function __construct($type = 'primary', $message = '', $dismissible = true)
    {
        $this->type = $type;
        $this->message = $message;
        $this->dismissible = $dismissible;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.partials.alert');
    }
}
