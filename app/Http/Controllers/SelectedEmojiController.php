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

    /**
     * Get the selected Emoji.
     *
     * @return string
     */
    public function getSelectedEmoji()
    {
        $emoji_id = session('emoji_id', 0);
        return $this->emoji_map[$emoji_id];
    }

    /**
     * Get the selected Emoji id.
     *
     * @return int
     */
    public function getSelectedEmojiId()
    {
        return session('emoji_id', 0);
    }

    /**
     * Set the selected Emoji id and redirect back.
     *
     * @return void
     */
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
        return redirect()->back();
    }

    /**
     * Get an Emoji by id from the emoji_map.
     *
     * @return string
     */
    public function getEmojiFromId($emoji_id)
    {
        return $this->emoji_map[$emoji_id];
    }

    /**
     * Get the emoji_map.
     *
     * @return array
     */
    public function getEmojiMap()
    {
        return $this->emoji_map;
    }
}