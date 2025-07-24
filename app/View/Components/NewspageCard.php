<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class NewsPageCard extends Component
{
    public string $title;
    public string $excerpt;
    public string $date;
    public string $category;
    public string $link;
    public ?string $image;

    /**
     * Create a new component instance.
     *
     * @param string $title
     * @param string $excerpt
     * @param string $date
     * @param string $category
     * @param string $link
     * @param string|null $image
     */
    public function __construct(string $title, string $excerpt, string $date, string $category = 'Berita', string $link = '#', ?string $image = null)
    {
        $this->title = $title;
        $this->excerpt = $excerpt;
        $this->date = $date;
        $this->category = $category;
        $this->link = $link;
        $this->image = $image;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return View|Closure|string
     */
    public function render(): View|Closure|string
    {
        return view('components.newspage-card');
    }
}
