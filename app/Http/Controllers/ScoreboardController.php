<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\GameStore;

class ScoreboardController extends Controller
{
    public function getScoreboard($codeLength)
    {
        // Only entries with won = 1, a non null value for score and column length equal to
        // $codeLength are considered. A lower score is better.
        $games = GameStore::where('won', 0)
            ->where('score', '!=', null)
            ->where('length', $codeLength)
            ->orderBy('score', 'asc')
            ->get();
        $scoreboard = [];
        foreach ($games as $game) {
            array_push($scoreboard, [
                'score' => $game->score,
                'id' => $game->id,
            ]);
        }

        return $scoreboard;
    }
}