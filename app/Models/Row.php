<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Game;
use App\Models\Slot;

class Row extends Model
{
    use HasFactory;

    protected $fillable = [
        'game_id',
    ];

    // Create x slots for each row on Row::create. x = $game->code_length.
    public static function boot()
    {
        parent::boot();

        static::created(function ($row) {
            $row->generateSlots($row->game->code_length);
        });
    }

    // Generate x slots.
    public function generateSlots($count)
    {
        for ($i = 0; $i < $count; $i++) {
            $slot = new Slot([
                'row_id' => $this->id,
            ]);

            $slot->save();
        }
    }


    // Relations
    public function game()
    {
        return $this->belongsTo(Game::class);
    }

    public function slots()
    {
        return $this->hasMany(Slot::class);
    }
}