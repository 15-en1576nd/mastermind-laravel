<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\GameDatabaseController;
use App\Rules\LegalEmoji;

class MastermindGameController extends Controller
{
    /**
     * Create a new mastermind game instance with the given difficulty
     * and redirect to the game page with the game id.
     *
     * @return void
     */
    public function create(Request $request)
    {
        $db = new GameDatabaseController();
        switch ($request->input('difficulty')) {
            case 'easy':
                $game = $db->makeNewGame(4);
                break;
            case 'medium':
                $game = $db->makeNewGame(5);
                break;
            case 'hard':
                $game = $db->makeNewGame(6);
                break;
            default:
                $game = $db->makeNewGame(4);
                break;
        }
        return redirect('/game/' . $game["id"]);
    }

    /**
     * Get the game with the given id and display it in the mastermind.game view.
     *
     * @return void
     */
    public function show(Request $request, $id)
    {
        $db = new GameDatabaseController();
        return view('mastermind.game', ['game' => $db->getGameByID($id)]);
    }

    /**
     * The function for changing the Emoji in a lot. The Emoji is derived from the request.
     *
     * @return void
     */
    public function update(Request $request, $id)
    {
        $db = new GameDatabaseController();
        $game = $db->getGameByID($id);

        $request->validate([
            'emoji_id' => ['required', 'string', new LegalEmoji],
            'slot' => ['required', 'integer', 'min:0', 'max:' . ($game->length - 1)],
        ]);

        $slot = (int)$request->input('slot');
        $emoji_id = $request->input('emoji_id');

        $board = json_decode($game['board']);
        $board[$game["turn"]][$slot] = $emoji_id;
        $game['board'] = json_encode($board);
        $game->save();
        return view('mastermind.game', ['game' => $game]);
    }

    /**
     * The function for making and checking the guess. The guess is derived from the database.
     * The function returns the game with the updated board and hints.
     *
     * @return void
     */
    public function guess(Request $request, $id)
    {
        $db = new GameDatabaseController();
        $game = $db->getGameByID($id);
        // Return the game if the game is over
        if ($game['lost'] == 1 || $game['won'] == 1) {
            return view('mastermind.game', ['game' => $game]);
        }
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

        // If the game is now over, either update won or lost
        if ($game["turn"] == 12) {
            if ($hints[$game["turn"] - 1] == array_fill(0, $game->length, 1)) {
                $game['won'] = 1;
            } else {
                $game['lost'] = 1;
            }
            // Score is updated_at - created-at (in seconds) divided by turns * 100
            // and rounded off to integer just to make it look more interesting
            $game['score'] = round($game->updated_at->diffInSeconds($game->created_at) / $game["turn"] * 100);
        }
        $game->save();
        return redirect()->back();
    }
}