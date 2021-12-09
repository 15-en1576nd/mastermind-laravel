<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class LegalGuess implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        // If the guess is not 4 numbers between 0 and 8, the user can't update the game
        return preg_match('/^[0-8]{4}$/', $value);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return trans('errors.legal_guess');
    }
}