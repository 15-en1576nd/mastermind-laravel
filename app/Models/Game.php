<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

use App\Models\Row;

class Game extends Model
{
    use HasFactory;

    protected $fillable = [
        'code_length',
        'selected_emoji',
        'turn',
        'user_id',
        'auth_token',
    ];

    // The emoji_map
    public $emoji_map = [
        0 => '',
        1 => '😊',
        2 => '😍',
        3 => '😘',
        4 => '😜',
        5 => '😎',
        6 => '😁',
        7 => '😉',
        8 => '😒',
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

    // Calculate the score of the game.
    public function calculateScore()
    {
        // Calculate the time it took by subtracting the created_at from the current time.
        $score = Carbon::now()->diffInSeconds($this->created_at);

        // Calculate the score by dividing the time taken by the turn.
        $score = $score / ($this->turn + 1);

        // Divide the score by $this->code_length.
        $score /= ($this->code_length - 3);

        // Multiply the score by 100 to make it look cool.
        $score *= 100;

        // Round the score to a whole number.
        $score = round($score);

        return $score;
    }


    // Relations
    public function rows()
    {
        return $this->hasMany(Row::class)->orderBy('id', 'asc');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}