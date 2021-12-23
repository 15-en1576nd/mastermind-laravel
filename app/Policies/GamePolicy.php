<?php

namespace App\Policies;

use App\Models\Game;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Http\Request;

class GamePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(?User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Game  $game
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(?User $user, Game $game)
    {
        return true;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(?User $user)
    {
        // Anyone can create a game.
        return true;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @param  \App\Models\Game  $game
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(Request $request, ?User $user, Game $game)
    {
        // If the game has a user_id field, then the game is owned by a user, so we check if the user is the owner.
        if ($game->user_id) {
            return $user->id === $game->user_id;
        }
        // Now we know auth_token is set, so we check if the auth_token is the same as the one in the session.
        if (in_array($game->auth_token, session('auth_token', []))) {
            return true;
        }
        // Final check is the Authorization header.
        return $request->header('Authorization') === $game->auth_token;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Game  $game
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Game $game)
    {
        // If the current user is the game's owner, they can delete the game.
        return $user->id === $game->user_id;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Game  $game
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Game $game)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Game  $game
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Game $game)
    {
        //
    }
}