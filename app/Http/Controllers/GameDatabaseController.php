<?php

namespace App\Http\Controllers;

use App\Models\GameStore;
use Illuminate\Http\Request;

class GameDatabaseController extends Controller
{
    function store(){
        $empty_board = [];
        for ($i = 0; $i < 12; $i++) {
            $empty_board[$i] = [0, 0, 0, 0];
        }
        $code = [];
        for ($i = 0; $i < 4; $i++) {
            $code[$i] = rand(1, 8);
        }
        $game = GameStore::create([
            'code' => join('', $code),
            'board' => json_encode($empty_board),
            'hints' => json_encode($empty_board),
            'lost' => 0,
            'won' => 0,
            'turn' => 0,
        ]);
        return $game;
    }
    function update($game){
        $gameupdate = GameStore::find($game['id']);
        $gameupdate->code = $game['code'];
        $gameupdate->board = $game['board'];
        $gameupdate->hints = $game['hints'];
        $gameupdate->lost = $game['lost'];
        $gameupdate->won = $game['won'];
        $gameupdate->turn = $game['turn'];
        $gameupdate->save();
        return $gameupdate;
    }
    function get($id){
        $gameupdate = GameStore::find($id);
        return $gameupdate;
    }
}
