<?php

namespace App\View\Components;

use App\Models\Page;
use App\Models\WidgetCategory;
use Illuminate\View\Component;

class ChooseUsComponent extends Component
{
    public WidgetCategory $chooseUsCategory;

    public Page $chooseUsWidgets;

    public function __construct($chooseUsCategory, $chooseUsWidgets)
    {
        $this->chooseUsCategory = $chooseUsCategory;
        $this->chooseUsWidgets = $chooseUsWidgets;
    }

    public function render()
    {
        return view('components.choose-us-component');
    }
}
