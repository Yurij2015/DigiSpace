<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class BlogAside extends Component
{
    /**
     * The sidebar data
     *
     * @var array
     */
    public array $sideBarData;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($sideBarData)
    {
        $this->sideBarData = $sideBarData;

    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return View|Closure|string
     */
    public function render(): View|string|Closure
    {
        return view('components.blog-aside');
    }
}
