<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UpdateSlotTest extends TestCase
{
    /**
     * Test that a slot can be updated with a valid value(1-8) and an invalid value.
     *
     * @return void
     */
    public function test_a_slot_can_be_updated()
    {
        $response = $this->post('/games', [
            'code_length' => 4,
        ]);
        $response->assertRedirect();
        $url_parts = explode('/', $response->headers->get('Location'));
        $game_id = end($url_parts);

        $row = \App\Models\Row::where('game_id', $game_id)->first();
        $slot = \App\Models\Slot::where('row_id', $row->id)->first();

        // Valid value
        $response = $this->put('/slots/' . $slot->id, [
            'value' => 1,
        ]);

        $response->assertStatus(200);
        // Make sure database was updated
        $this->assertEquals(1, \App\Models\Slot::find($slot->id)->value);

        // Invalid value
        $response = $this->put('/slots/' . $slot->id, [
            'value' => 9,
        ]);

        $response->assertStatus(422);
        // Make sure database was not updated
        $this->assertEquals(1, \App\Models\Slot::find($slot->id)->value);
    }
}
