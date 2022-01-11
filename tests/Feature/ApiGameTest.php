<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ApiGameTest extends TestCase
{
    /**
     * Methods:
     * - GET /api/games: Return all games.
     * - GET /api/games/{id}: Return the game with the given id.
     *      - make sure auth_token is not returned.
     * - POST /api/games: Create a new game.
     *      - Has to have code_length in body.
     *      - Has to return game with auth_token.
     *
     * @return void
     */
    public function test_game_index()
    {
        $response = $this->get('/api/games');

        $response->assertStatus(200);
        $response->assertJsonStructure([
            '*' => [
                'id',
                'code_length',
                'selected_emoji',
                'turn',
                'user_id',
            ],
        ]);
    }
    public function test_game_create()
    {
        $response = $this->post('/api/games', [
            'code_length' => 4,
        ]);

        $response->assertStatus(200);
        $response->assertJsonStructure([
            'id',
            'code_length',
            'selected_emoji',
            'turn',
            'user_id',
            'auth_token',
        ]);
    }
    public function test_game_show()
    {
        $response = $this->post('/api/games', [
            'code_length' => 4,
        ]);

        $id = json_decode($response->getContent())->id;

        $response = $this->get("/api/games/$id");

        $response->assertStatus(200);
        $response->assertJsonStructure([
            'id',
            'code_length',
            'selected_emoji',
            'turn',
            'user_id',
        ]);
    }
    public function test_game_update()
    {
        $response = $this->post('/api/games', [
            'code_length' => 4,
        ]);

        $id = json_decode($response->getContent())->id;
        $auth_token = json_decode($response->getContent())->auth_token;

        // Set Authorization header
        $this->withHeaders([
            'Authorization' => $auth_token,
        ]);
        $response = $this->put("/api/games/$id", [
            'selected_emoji' => 1,
        ]);

        $response->assertStatus(200);
        $response->assertJsonStructure([
            'id',
            'code_length',
            'selected_emoji',
            'turn',
            'user_id',
        ]);
        // Make sure the database has the updated selected_emoji.
        $this->assertDatabaseHas('games', [
            'id' => $id,
            'selected_emoji' => 1,
        ]);
    }
}
