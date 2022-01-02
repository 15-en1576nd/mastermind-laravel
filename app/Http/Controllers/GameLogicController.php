<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Game;

class GameLogicController extends Controller
{
    public function guess(Game $game) {
        $game->guess();
        return redirect()->back();
    }
}
