<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class MastermindGameControllerTest extends TestCase
{
    /**
     * The controller should have the following methods:
     * index: GET /game
     * - Should not return 200
     * create: GET /game/create
     * - Should return a redirect to /game/<id> where <id> is a random string
     * update: PUT /game/<id> with a body of {'guess': '<guess>'} where <guess> is a string of 4 valid emoji_id's(1-8)
     */
    public function testIndex()
    {
        $response = $this->get('/game');
        $status = $response->getStatusCode();
        $this->assertNotEquals(200, $status);
    }

    public function testCreate()
    {
        $response = $this->get('/game/create');
        $response->assertStatus(302);
    }

    public function testUpdate()
    {
        $game_url = $this->get('/game/create')->getTargetUrl();

        $response = $this->json('PUT', $game_url, ['emoji_id' => '6', 'slot' => '1']);
        $response->assertStatus(200);

        // Make sure that the guess actually persisted
        $response = $this->get($game_url);
        $response->assertSee('😁');

        // Attempt a guess, which should redirect back
        $response = $this->post($game_url . '/guess');
        $response->assertStatus(302);
        $response->assertRedirect($game_url);
    }

    public function testUpdateInvalidGuess()
    {
        $game_url = $this->get('/game/create')->getTargetUrl();

        $response = $this->json('PUT', $game_url, ['guess' => '6546a']);
        $response->assertStatus(422);

        $response = $this->json('PUT', $game_url, ['guess' => '9999']);
        $response->assertStatus(422);
    }
}