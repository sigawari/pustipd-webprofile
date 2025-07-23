<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class PartnerCard extends Component
{
    public $name;
    public $logo;
    public $link;

    public function __construct($name, $logo = null, $link = '#')
    {
        $this->name = $name;
        $this->logo = $logo;
        $this->link = $link;
    }

    public function render(): View|Closure|string
    {
        return view('components.partner-card');
    }
}
