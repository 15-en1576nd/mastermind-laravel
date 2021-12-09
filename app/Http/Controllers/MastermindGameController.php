<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\MastermindDatabaseController;
use App\Rules\LegalGuess;

class MastermindGameController extends Controller
{
    public function create(Request $request)
    {
        $db = new MastermindDatabaseController();
        $game = $db->store();
        return redirect('/game/' . $game["id"]);
    }

    public function show(Request $request, $id)
    {
        $db = new MastermindDatabaseController();
        return view('mastermind.game', ['game' => $db->get($id)]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'guess' => ['required', 'string', new LegalGuess],
        ]);

        $db = new MastermindDatabaseController();
        $game = $db->get($id);
        $game["board"][$game["turn"]] = $request->input('guess');
        $db->update($game);
        return view('mastermind.game', ['game' => $game]);
    }
}