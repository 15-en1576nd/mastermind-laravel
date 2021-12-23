<?php

namespace App\Policies;

use App\Models\Game;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

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
     * @param  \App\Models\User  $user
     * @param  \App\Models\Game  $game
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(?User $user, Game $game)
    {
        // If the game has a user_id field, then the game is owned by a user.
        // Else, the game is owned by a guest, and we need to check auth_token.
        return is_null($game->user_id) ?
            (in_array($game->auth_token, session('auth_token', []))
                // Also check for da API token tho.
                || $game->auth_token === request()->header('Authorization')
            ) :
            $game->user_id === $user->id;
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
