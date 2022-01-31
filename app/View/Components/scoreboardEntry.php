<?php

namespace App\View\Components;

use Illuminate\View\Component;

class scoreboardEntry extends Component
{
    public $id;
    public $score;
    public $rank;
    public $difficulty;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($id, $score, $rank, $difficulty)
    {
        $this->id = $id;
        $this->score = $score;
        $this->rank = $rank;
        $this->difficulty = $difficulty;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.scoreboard-entry');
    }
}