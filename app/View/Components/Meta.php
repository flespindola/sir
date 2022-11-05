<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Meta extends Component
{

    public $title;

    public $description;

    public $image;

    public $keywords;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($title, $description, $image, $keywords)
    {
        $this->title = $title;
        $this->description = $description;
        $this->image = $image;
        $this->keywords = $keywords;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.meta');
    }
}
