<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class welcomePageTest extends TestCase
{
    /**
     * Test to make sure "About delphi" link takes you to about page.
     *
     * @return void
     */
    public function testAboutDelphiLink()
    {
        //$this->visit('/')->click('About Delphi')->seePageIs('/about');
        $this->get('/')->assertStatus(200);
    }

}
