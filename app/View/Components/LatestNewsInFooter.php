<?php

namespace App\View\Components;

use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\View\Component;

class LatestNewsInFooter extends Component
{
    public Collection $footerLatestNews;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(Collection $footerLatestNews)
    {
        $this->footerLatestNews = $footerLatestNews;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return View
     */
    public function render(): View
    {
        return view('components.latest-news-in-footer');
    }
}
