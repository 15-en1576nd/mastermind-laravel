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
     * - Should return a 404
     * create: GET /game/create
     * - Should return a redirect to /game/<id> where <id> is a random string
     * update: PUT /game/<id> with a body of {'guess': '<guess>'} where <guess> is a string of 4 valid emoji_id's(1-8)
     */
    public function testIndex()
    {
        $response = $this->get('/game');
        $response->assertStatus(404);
    }

    public function testCreate()
    {
        $response = $this->get('/game/create');
        $response->assertStatus(302);
    }

    public function testUpdate()
    {
        $game_url = $this->get('/game/create')->getTargetUrl();
    
        $response = $this->put($game_url, ['guess' => '1234']);
        $response->assertStatus(200);
    }
}
