<?php

namespace App\View\Components;

use Illuminate\Contracts\View\View;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\View\Component;

class ListOfServices extends Component
{
    /**
     * The services list
     */
    public LengthAwarePaginator $listOfServices;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($listOfServices)
    {
        $this->listOfServices = $listOfServices;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View
    {
        return view('components.list-of-services');
    }
}
