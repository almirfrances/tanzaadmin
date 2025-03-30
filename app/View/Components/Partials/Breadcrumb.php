<?php

namespace App\View\Components\Partials;

use Illuminate\View\Component;

class Breadcrumb extends Component
{
    /**
     * The breadcrumb items.
     *
     * @var array
     */
    public $items;

    /**
     * The breadcrumb style.
     *
     * @var string
     */
    public $style;

    /**
     * Create a new component instance.
     *
     * @param  array  $items
     * @param  string  $style
     * @return void
     */
    public function __construct($items = [], $style = 'style2')
    {
        $this->items = $items;
        $this->style = $style;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render()
    {
        return view('components.partials.breadcrumb');
    }
}
