<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\GameDatabaseController;
use App\Rules\LegalEmoji;

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
            'emoji_id' => ['required', 'string', new LegalEmoji],
            'slot' => ['required', 'integer', 'min:0', 'max:3'],
        ]);

        $db = new GameDatabaseController();
        $game = $db->get($id);

        $slot = (int)$request->input('slot');
        $emoji_id = $request->input('emoji_id');

        $board = json_decode($game['board']);
        $board[$game["turn"]][$slot] = $emoji_id;
        $game['board'] = json_encode($board);
        $db->update($game);
        return view('mastermind.game', ['game' => $game]);
    }
}
