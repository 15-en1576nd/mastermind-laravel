<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\GameStore;

class ScoreboardController extends Controller
{
    /**
     * Go through all games and return an array with the top 10 scores sorted by score where
     * lower scores are at the top.
     *
     * @return [
     *   'score' => int,
     *   'id' => int,
     * ][]
     */
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