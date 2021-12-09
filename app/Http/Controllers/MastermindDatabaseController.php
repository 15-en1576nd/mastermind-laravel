<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MastermindDatabaseController extends Controller
{
    public function store()
    {
        $board = [];
        for ($i = 0; $i < 12; $i++) {
            $board[$i] = [0, 0, 0, 0];
        }
        $game = [
            'id' => 'aiojd',
            'code' => '1234',
            // Not a reference, but a deep copy
            'board' => $board,
            'hints' => $board,
            'lost' => false,
            'won' => false,
            'turn' => 0,
        ];
        session()->put('game', $game);
        return session()->get('game');
    }
    public function update($game)
    {
        session()->put('game', $game);
        return session('game');
    }
    public function get($id)
    {
        return session()->get('game');
    }
}