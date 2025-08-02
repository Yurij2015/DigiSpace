<?php

namespace App\View\Components;

use App\Models\BlogPostBanner;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class BlogAside extends Component
{
    /**
     * The sidebar data
     */
    public array $sideBarData;

    public int $postsNumber;

    public ?BlogPostBanner $banner = null;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($sideBarData, $postsNumber, $banner)
    {
        $this->sideBarData = $sideBarData;
        $this->postsNumber = $postsNumber;
        $this->banner = $banner;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View
    {
        return view('components.blog-aside');
    }
}
