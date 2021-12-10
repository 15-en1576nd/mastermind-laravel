<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GameStore extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'board',
        'hints',
        'lost',
        'won',
        'turn',
    ];
}
