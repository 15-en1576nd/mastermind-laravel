<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class GameCreateTest extends TestCase
{
    /**
     * Test if the game can be created.
     *
     * @return void
     */
    public function test_game_create()
    {
        $response = $this->post('/games', [
            'code_length' => 4,
        ]);

        $response->assertStatus(302);
        // /games/{id}
        $url = $response->headers->get('Location');
        $id = substr($url, strrpos($url, '/') + 1);
        $this->assertTrue(is_numeric($id));
        $response->assertRedirect("/games/$id");

        // Make sure it is in the database
        $this->assertDatabaseHas('games', [
            'id' => $id,
            'code_length' => 4,
        ]);
    }
}