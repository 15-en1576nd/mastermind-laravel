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
        $url = $response->headers->get('Location');
        $id = substr($url, strrpos($url, '/') + 1);

        $response = $this->put("/games/$id", [
            'selected_emoji' => 1,
        ]);

        $this->assertDatabaseHas('games', [
            'id' => $id,
            'selected_emoji' => 1,
        ]);

        $response->assertStatus(200);
    }
}