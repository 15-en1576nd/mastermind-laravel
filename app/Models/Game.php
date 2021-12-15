<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    use HasFactory;

    protected $fillable = [
        'code_length',
        'selected_emoji',
        'turn',
    ];

    // Generate a code on Game::create().
    public static function boot()
    {
        parent::boot();

        static::creating(function ($game) {
            $game->code = $game->generateCode();
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

    // Relations
    public function rows()
    {
        return $this->hasMany(Row::class);
    }
}