<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Route;

class SidebarItemGroup extends Component
{
    public bool $isActive;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(
        array $routes = []
    ) {
        $this->isActive = in_array(Route::currentRouteName(), $routes);
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.sidebar-item-group');
    }
}