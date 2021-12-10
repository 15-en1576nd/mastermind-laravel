<?php

namespace App\View\Components;

use Illuminate\View\Component;

class emojipicker extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        /// Use this whenever it's fixed
        // $emoji_controller = app('App\Http\Controllers\SelectedEmojiController');
        // $this->selected = $emoji_controller->index()["emoji_id"];
        // $this->emoji_map = $emoji_controller->getEmojiMap();
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.emojipicker');
    }
}