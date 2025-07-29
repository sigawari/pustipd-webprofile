<?php

namespace App\View\Components;

use Illuminate\View\Component;

class AchievementCard extends Component
{
    public $subtitle;
    public $title;
    public $icon;

    /**
     * Create a new component instance.
     */
    public function __construct($subtitle = '', $title = '', $icon = null)
    {
        $this->subtitle = $subtitle;
        $this->title = $title;
        $this->icon = $icon;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render()
    {
        return view('components.achievement-card');
    }
}
