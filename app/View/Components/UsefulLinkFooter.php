<?php

namespace App\View\Components;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\View\Component;

class UsefulLinkFooter extends Component
{
    public Collection $footerUsefulLinks;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(Collection $footerUsefulLinks)
    {
        $this->footerUsefulLinks = $footerUsefulLinks;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return Application|Factory|View
     */
    public function render(): View|Factory|Application
    {
        return view('components.useful-link-footer');
    }
}
