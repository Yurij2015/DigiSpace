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
    public int $postsNumber;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($sideBarData, $postsNumber)
    {
        $this->sideBarData = $sideBarData;
        $this->postsNumber = $postsNumber;

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
