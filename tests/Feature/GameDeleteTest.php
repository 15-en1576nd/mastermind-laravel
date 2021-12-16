<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class GameDeleteTest extends TestCase
{
    /**
     * Test that the game can be deleted.
     *
     * @return void
     */
    public function test_game_delete()
    {
        $response = $this->post('/games', [
            'code_length' => 4,
        ]);

        $response->assertRedirect();

        $url = $response->headers->get('Location');
        $url_parts = explode('/', $url);
        $id = (int)$url_parts[count($url_parts) - 1];

        $response = $this->delete("/games/$id");

        $response->assertRedirect();

        $this->assertDatabaseMissing('games', [
            'id' => $id,
        ]);
    }
}