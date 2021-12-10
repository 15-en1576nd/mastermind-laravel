<?php

namespace App\Http\Controllers;

use App\Models\GameStore;
use Illuminate\Http\Request;

class GameDatabaseController extends Controller
{
    function store($id, $game){
        $game = GameStore::create([
            'code' => $game['code'],
            'board' => $game['board'],
            'hints' => $game['hints'],
            'lost' => $game['lost'],
            'won' => $game['won'],
            'turn' => $game['turn'],
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
