<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Slot extends Model
{
    use HasFactory;

    protected $fillable = [
        'row_id',
        'value',
        'hint',
    ];

    public function row()
    {
        return $this->belongsTo(Row::class);
    }
}