<?php

namespace App\View\Components;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Footer extends Component
{
    /**
     * The footer phone.
     *
     * @var object
     */
    public object $footerWidgets;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($footerWidgets)
    {
        $this->footerWidgets = $footerWidgets;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return Application|Factory|View
     */
    public function render(): View|Factory|Application
    {
        return view('components.footer');
    }
}
