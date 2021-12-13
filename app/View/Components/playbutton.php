<?php

namespace App\View\Components;

use Illuminate\View\Component;

class playbutton extends Component
{
    public $difficulty;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($difficulty)
    {
        $this->difficulty = $difficulty;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.playbutton');
    }
}