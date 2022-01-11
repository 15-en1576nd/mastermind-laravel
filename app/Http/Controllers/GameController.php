<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Gate;
use App\Http\Requests\StoreGameRequest;
use App\Http\Requests\UpdateGameRequest;
use App\Models\Game;

class GameController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Return a 404 error because getting all games is not allowed.
        abort(404);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // / already has a form for creating a new game.
        return redirect('/');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreGameRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreGameRequest $request)
    {
        // Create a new game.
        $game = Game::create(
            [
                // The logged in user is the owner of the game or null if the user is not logged in.
                'user_id' => auth()->id(),
                // Generate a semi-random auth token if the user is not logged in.
                'auth_token' => is_null(auth()->id()) ? substr(md5(uniqid(rand(), true)), 0, 32) : null,
                // For some reason, PHP does not support proper spread operator syntax, so we have to do this manually.
                'code_length' => $request->validated()['code_length'],
            ]
        );
        // If the auth_token was generated, we need to save it in the user's session.
        if (!is_null($game->auth_token)) {
            if (!session()->has('auth_token')) {
                session()->put('auth_token', []);
            }
            session()->push('auth_token', $game->auth_token);
        }
        // Redirect to the game's page.
        return redirect()->route('games.show', $game);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Game  $game
     * @return \Illuminate\Http\Response
     */
    public function show(Game $game)
    {
        // Return the game's page.
        return view('games.show', compact('game'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Game  $game
     * @return \Illuminate\Http\Response
     */
    public function edit(Game $game)
    {
        // The games show page is the page used for editing the game.
        return redirect()->route('games.show', $game);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateGameRequest  $request
     * @param  \App\Models\Game  $game
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateGameRequest $request, Game $game)
    {
        // Update the game.
        $game->update($request->validated());
        // Redirect to the game's page.
        return redirect()->route('games.show', $game);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Game  $game
     * @return \Illuminate\Http\Response
     */
    public function destroy(Game $game)
    {
        // Delete the game.
        $game->delete();
        // Redirect to the home page.
        return redirect('/');
    }

    /**
     * Make a guess on the guess
     *
     * @param  \App\Models\Game  $game
     * @return \Illuminate\Http\Response
     */
    public function guess(Game $game) {
        if (!Gate::allows('update', $game)) {
            // Return a 403 error because the user is not allowed to update the game.
            abort(403);
        }
        $game->guess();
        return redirect()->back();
    }
}
