<?php

namespace App\View\Components;

use Illuminate\View\Component;

class socialmediabuttons extends Component
{
    public $game;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($game)
    {
        $this->game = $game;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.socialmediabuttons');
    }
}
