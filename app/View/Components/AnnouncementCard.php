<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class AnnouncementCard extends Component
{
    public $title;
    public $excerpt;
    public $date;
    public $category;
    public $link;
    public $priority;

    public function __construct($title, $excerpt, $date, $category = 'Pengumuman', $link = '#', $priority = 'normal')
    {
        $this->title = $title;
        $this->excerpt = $excerpt;
        $this->date = $date;
        $this->category = $category;
        $this->link = $link;
        $this->priority = $priority;
    }

    public function render(): View|Closure|string
    {
        return view('components.announcement-card');
    }
}
