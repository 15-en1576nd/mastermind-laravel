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

    // Don't serialize the auth token.
    protected $hidden = [
        'auth_token',
        'code',
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

        // Generate a random code of numbers 1-8 with length $this->code_length.
        // Where there are not any instances of the same number more than once.
        for ($i = 0; $i < $this->code_length; $i++) {
            $number = rand(1, 8);

            // Search through the code and see if the number is already in the code. If it is, generate a new number.
            while (strpos($code, $number) !== false) {
                $number = rand(1, 8);
            }

            $code .= $number;
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
    // Funtion for making guesses
    public function guess()
    {
        if ($this->lost || $this->won) return;
        // we do 11 minus because the turn reversed
        $current_row = &$this->rows[11 - $this->turn];
        $slots = &$current_row->slots;
        $code = str_split($this->code);
        $guess_code = $slots->pluck('value');

        // Generate hints
        foreach ($guess_code as $i => $current) {
            if ($current == $code[$i]) {
                $slots[$i]->hint = 1; // exact match
            } elseif (in_array($current, $code)) {
                $slots[$i]->hint = 2; // near match
            } else {
                $slots[$i]->hint = 0; // no match
            }
            $slots[$i]->save();
        }
        // Win or lost
        if ($guess_code->toArray() == $code) {
            $this->won = true;
            $this->score = $this->calculateScore();
        } else {
            $this->turn++;
            if ($this->turn == $this->rows->count()) {
                $this->lost = true;
            }
        }
        $this->save();
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
