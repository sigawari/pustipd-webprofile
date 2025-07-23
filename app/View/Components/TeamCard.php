<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class TeamCard extends Component
{
    public $name;
    public $position;
    public $image;
    public $initials;

    public function __construct($name, $position, $image = null)
    {
        $this->name = $name;
        $this->position = $position;
        $this->image = $image;
        $this->initials = $this->generateInitials($name);
    }

    private function generateInitials($name)
    {
        $words = explode(' ', $name);
        $initials = '';
        foreach ($words as $word) {
            $initials .= strtoupper(substr($word, 0, 1));
        }
        return substr($initials, 0, 2); // Maksimal 2 karakter
    }

    public function render(): View|Closure|string
    {
        return view('components.team-card');
    }
}
