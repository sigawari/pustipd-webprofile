<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class NewsCard extends Component
{
    public $title;
    public $excerpt;
    public $date;
    public $category;
    public $link;
    public $image;

    public function __construct($title, $excerpt, $date, $category = 'Berita', $link = '#', $image = null)
    {
        $this->title = $title;
        $this->excerpt = $excerpt;
        $this->date = $date;
        $this->category = $category;
        $this->link = $link;
        $this->image = $image;
    }

    public function render(): View|Closure|string
    {
        return view('components.news-card');
    }
}
