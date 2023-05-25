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
    public ?string $bannerImg = null;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($sideBarData, $postsNumber, $bannerImg)
    {
        $this->sideBarData = $sideBarData;
        $this->postsNumber = $postsNumber;
        $this->bannerImg = $bannerImg;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return View
     */
    public function render(): View
    {
        return view('components.blog-aside');
    }
}
