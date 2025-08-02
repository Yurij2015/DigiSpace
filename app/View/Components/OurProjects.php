<?php

namespace App\View\Components;

use App\Models\Page;
use App\Models\WidgetCategory;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class OurProjects extends Component
{
    public WidgetCategory $clientsCategory;

    public Page $clients;

    public function __construct($clientsCategory, $clients)
    {
        $this->clientsCategory = $clientsCategory;
        $this->clients = $clients;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Factory|Application
    {
        return view('components.our-projects');
    }
}
