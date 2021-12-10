<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SelectedEmojiController extends Controller
{
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

    public function index()
    {
        $emoji_id = session('emoji_id', 2);
        $emoji = $this->emoji_map[$emoji_id];

        return [
            'emoji' => $emoji,
            'emoji_id' => $emoji_id,
        ];
    }

    public function store(Request $request) {
        $emoji_id = $request->input('emoji_id');
        // Make sure the emoji_id is valid
        if (!isset($this->emoji_map[$emoji_id])) {
            return response()->json([
                // Doesn't need to be translated, because it's not a user-facing error
                'error' => 'Invalid emoji_id',
            ], 400);
        }
        session(['emoji_id' => $emoji_id]);
        return [
            'emoji' => $this->emoji_map[$emoji_id],
            'emoji_id' => $emoji_id,
        ];
    }

    public function getEmoji($emoji_id)
    {
        return [
            'emoji' => $this->emoji_map[$emoji_id],
            'emoji_id' => $emoji_id,
        ];
    }
}