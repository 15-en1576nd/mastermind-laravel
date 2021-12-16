<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class GameUpdateTest extends TestCase
{
    /**
     * Test that the game can be updated with only selected_emoji.
     *
     * @return void
     */
    public function test_game_update()
    {
        $response = $this->post('/games', [
            'code_length' => 4,
        ]);

        $response->assertRedirect();

        $url = $response->headers->get('Location');
        $url_parts = explode('/', $url);
        $id = (int)$url_parts[count($url_parts) - 1];

        $response = $this->put("/games/$id", [
            'selected_emoji' => 1,
        ]);

        $response->assertRedirect("/games/$id");

        $this->assertDatabaseHas('games', [
            'id' => $id,
            'selected_emoji' => 1,
        ]);
    }
}