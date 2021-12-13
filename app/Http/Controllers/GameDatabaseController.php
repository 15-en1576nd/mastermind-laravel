<?php

namespace App\Http\Controllers;

use App\Models\GameStore;
use Illuminate\Http\Request;

class GameDatabaseController extends Controller
{
    function store($length)
    {
        $empty_board = [];
        for ($i = 0; $i < 12; $i++) {
            $empty_board[$i] = [];
            for ($j = 0; $j < $length; $j++) {
                $empty_board[$i][$j] = 0;
            }
        }
        $code = [];
        for ($i = 0; $i < $length; $i++) {
            $code[$i] = rand(1, 8);
        }
        $game = GameStore::create([
            'code' => join('', $code),
            'board' => json_encode($empty_board),
            'hints' => json_encode($empty_board),
            'length' => $length,
            'lost' => 0,
            'won' => 0,
            'turn' => 0,
        ]);
        return $game;
    }
    function get($id){
        $gameupdate = GameStore::find($id);
        return $gameupdate;
    }
}