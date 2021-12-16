<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Game;

class GameLogicController extends Controller
{
    public function guess(Game $game) {
        if($game->lost || $game->won) return redirect()->back();
        // we do 11 minus because the turn reversed
        $current_row = &$game->rows[11-$game->turn];
        $slots = &$current_row->slots;
        $code = str_split($game->code);
        $guess_code = $slots->pluck('value');

        // Generate hints
        foreach ($guess_code as $i => $current) {
            if ($current == $code[$i]) {
                $slots[$i]->hint = 1; // exact match
            } elseif (in_array($current, $code)) {
                $slots[$i]->hint = 2; // near match
            } else {
                $slots[$i]->hint = 0; // no match
            }
        }
        // Win or lost
        if ($guess_code->toArray() == $code) {
            $game->won = true;
        } else {
            $game->turn++;
            if ($game->turn == $game->rows->count()) {
                $game->lost = true;
            }
        }
        $game->save();
        return redirect()->back();
    }
}
