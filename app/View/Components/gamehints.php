<?php

namespace App\View\Components;

use Illuminate\View\Component;

class gamehints extends Component
{
    public $hints;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($hints)
    {
        // Hints are stored as an array of integers, where 0 is no match, 1 is an exact match, and 2 is a partial match.
        $this->hints = $hints;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.gamehints');
    }
}