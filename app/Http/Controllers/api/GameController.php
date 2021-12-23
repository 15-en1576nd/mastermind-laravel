<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Game;
use Illuminate\Http\Request;
use App\Http\Requests\StoreGameRequest;
use App\Http\Requests\UpdateGameRequest;

class GameController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(Game::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreGameRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreGameRequest $request)
    {
        // Create a new game with an auth token, since API requests are not authenticated.
        $game = Game::create(
            [
                'user_id' => null,
                'auth_token' => substr(md5(uniqid(rand(), true)), 0, 32),
                'code_length' => $request->validated()['code_length'],
            ]
        );
        $game->save();
        // Return the game with the auth_token.
        return response()->json($game->makeVisible([
            'auth_token',
        ]));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Game  $game
     * @return \Illuminate\Http\Response
     */
    public function show(Game $game)
    {
        return response()->json($game);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\UpdateGameRequest  $request
     * @param  \App\Models\Game  $game
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateGameRequest $request, Game $game)
    {
        $game->update($request->validated());
        return response()->json($game);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Game  $game
     * @return \Illuminate\Http\Response
     */
    public function destroy(Game $game)
    {
        $game->delete();
        return response()->json($game);
    }
}