<?php

namespace App\View\Components\Modals;

use Illuminate\View\Component;

class Simple extends Component
{
    public string $id;
    public string $title;

    /**
     * Create a new component instance.
     */
    public function __construct(string $id, string $title)
    {
        $this->id = $id;
        $this->title = $title;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render()
    {
        return view('components.modals.simple');
    }
}
