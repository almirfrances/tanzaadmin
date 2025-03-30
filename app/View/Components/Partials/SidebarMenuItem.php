<?php

namespace App\View\Components\Partials;

use Illuminate\View\Component;

class SidebarMenuItem extends Component
{
    public $route;
    public $icon;
    public $label;
    public $active;

    public function __construct($route, $icon, $label, $active = null)
    {
        $this->route = $route;
        $this->icon = $icon;
        $this->label = $label;
        $this->active = $active ?? request()->routeIs($route . '*');
    }

    public function render()
    {
        return view('components.partials.sidebar-menu-item');
    }
}
