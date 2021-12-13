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
        switch ($request->input('difficulty')) {
            case 'easy':
                $game = $db->store(4);
                break;
            case 'medium':
                $game = $db->store(5);
                break;
            case 'hard':
                $game = $db->store(6);
                break;
            default:
                $game = $db->store(4);
                break;
        }
        return redirect('/game/' . $game["id"]);
    }

    public function show(Request $request, $id)
    {
        $db = new GameDatabaseController();
        return view('mastermind.game', ['game' => $db->get($id)]);
    }

    public function update(Request $request, $id)
    {
        $db = new GameDatabaseController();
        $game = $db->get($id);

        $request->validate([
            'emoji_id' => ['required', 'string', new LegalEmoji],
            'slot' => ['required', 'integer', 'min:0', 'max:' . ($game->length - 1)],
        ]);

        $slot = (int)$request->input('slot');
        $emoji_id = $request->input('emoji_id');

        $board = json_decode($game['board']);
        $board[$game["turn"]][$slot] = $emoji_id;
        $game['board'] = json_encode($board);
        $db->update($game);
        return view('mastermind.game', ['game' => $game]);
    }

    public function guess(Request $request, $id)
    {
        $db = new GameDatabaseController();
        $game = $db->get($id);
        $hints = json_decode($game['hints']);
        $board = json_decode($game['board']);
        $guess = $board[$game["turn"]];
        // Generate hints
        for ($i = 0; $i < $game->length; $i++) {
            if ($guess[$i] == $game["code"][$i]) {
                // Exact match
                $hints[$game["turn"]][$i] = 1;
            } elseif (in_array($guess[$i], str_split($game["code"]))) {
                // Partial match
                $hints[$game["turn"]][$i] = 2;
            } else {
                // No match
                $hints[$game["turn"]][$i] = 0;
            }
        }
        // Update game
        $game['hints'] = json_encode($hints);
        $game['turn'] = $game["turn"] + 1;
        $db->update($game);
        return redirect()->back();
    }
}