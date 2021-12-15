<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateGameRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            "board.{$this->game->board[$this->game->turn]}" => 'required|array',
            "board.{$this->game->board[$this->game->turn]}.x" => "required|integer|min:0|max:{$this->game->code_length}",
        ];
    }
}