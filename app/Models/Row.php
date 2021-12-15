<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Row extends Model
{
    use HasFactory;

    protected $fillable = [
        'game_id',
    ];

    public function game()
    {
        return $this->belongsTo(Game::class);
    }

    public function slots()
    {
        return $this->hasMany(Slot::class);
    }
}