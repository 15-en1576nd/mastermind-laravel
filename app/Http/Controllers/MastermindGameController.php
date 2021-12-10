<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\GameDatabaseController;
use App\Rules\LegalGuess;

class MastermindGameController extends Controller
{
    public function create(Request $request)
    {
        $db = new GameDatabaseController();
        $game = $db->store();
        return redirect('/game/' . $game["id"]);
    }

    public function show(Request $request, $id)
    {
        $db = new GameDatabaseController();
        return view('mastermind.game', ['game' => $db->get($id)]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'guess' => ['required', 'string', new LegalGuess],
        ]);

        $db = new GameDatabaseController();
        $game = $db->get($id);
        // Make every characer of the guess a seperate element in an array
        $str_guesses = str_split($request->input('guess'));
        $int_guesses = [];
        foreach ($str_guesses as $char) {
            array_push($int_guesses, intval($char));
        }

        $game["board"][$game["turn"]] = $int_guesses;
        $db->update($game);
        return view('mastermind.game', ['game' => $game]);
    }
}
