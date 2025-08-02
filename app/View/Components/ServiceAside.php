<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\View\Component;

class ServiceAside extends Component
{
    public Collection $serviceCategories;

    /**
     * Create a new component instance.
     */
    public function __construct($serviceCategories)
    {
        $this->serviceCategories = $serviceCategories;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.service-aside');
    }
}
