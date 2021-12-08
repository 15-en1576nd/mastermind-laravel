<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SelectedEmojiControllerTest extends TestCase
{
    /**
     * Supports:
     * - POST request with a body of an integer emoji_id, which is between 0 and 8
     *   - Should return status code 200
     *   - When the number is not between 0 and 8, should return status code 400
     *   - There should be an emoji_id in session
     * - GET request
     *  - Should return status code 200
     *  - Returns {emoji_id: integer, emoji: string}
     *  - Emoji_id should default to 0
     *
     * @return void
     */
    public function test_post_request_with_valid_emoji_id()
    {
        $response = $this->post('/selected-emoji', ['emoji_id' => 0]);
        $response->assertStatus(200);
        $response->assertSessionHas('emoji_id');
        $this->assertIsInt(session()->get('emoji_id'));
    }

    public function test_post_request_with_invalid_emoji_id()
    {
        $response = $this->post('/selected-emoji', ['emoji_id' => 9]);
        $response->assertStatus(400);
        // Make sure the emoji_id didn't get set in session
        $this->assertNull(session()->get('emoji_id'));
    }

    public function test_get_request()
    {
        $response = $this->get('/selected-emoji');
        $response->assertStatus(200);
        $response->assertJson(['emoji_id' => 0, 'emoji' => '']);
    }
}
