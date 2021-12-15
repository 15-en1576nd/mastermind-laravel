<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Row;

class Game extends Model
{
    use HasFactory;

    protected $fillable = [
        'code_length',
        'selected_emoji',
        'turn',
    ];

    // Generate a code and a board on Game::create().
    public static function boot()
    {
        parent::boot();

        static::creating(function ($game) {
            $game->code = $game->generateCode();
        });

        static::created(function ($game) {
            $game->generateEmptyBoard();
        });
    }

    // Generate a code.
    public function generateCode()
    {
        $code = '';

        for ($i = 0; $i < $this->code_length; $i++) {
            $code .= rand(1, 8);
        }

        return $code;
    }

    // Make 12 game rows with game_id of the current game.
    public function generateEmptyBoard()
    {
        for ($i = 0; $i < 12; $i++) {
            $row = new Row([
                'game_id' => $this->id,
            ]);

            $row->save();
        }
    }


    // Relations
    public function rows()
    {
        return $this->hasMany(Row::class);
    }
}
