<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ServiceCard extends Component
{
    public $title;
    public $description;
    public $link;

    public function __construct($title, $description)
    {
        $this->title = $title;
        $this->description = $description;
    }

    public function render(): View|Closure|string
    {
        return view('components.service-card');
    }
}
