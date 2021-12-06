<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LocalizationTest extends TestCase
{
    /**
     * A basic test to see if localization works.
     *
     * @return void
     */
    public function test_instructions_are_localized()
    {
        // Make sure the page is in English
        $this->get('/')
            ->assertSee('Mastermind is a code-breaking game');
        
        // Change the locale to Dutch, should redirect to /
        $this->get('/language/nl')
            ->assertRedirect('/');
        
        // Check if the instructions are now Dutch
        $this->get('/')
            ->assertSee('Mastermind is een code-brekend spel');
    }
}
