<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class HttpTest extends TestCase
{
    /**
     * Test index page ('/')
     *
     * @return void
     */
    public function testIndexPage()
    {
        $response = $this->get('/');
        $response->assertStatus(200);
    }

    /**
     * Test contact page ('/contact')
     *
     * @return void
     */
    public function testContactPage()
    {
        $response = $this->get('/contact');
        $response->assertStatus(200);
    }


    /**
     * Test about page ('/about')
     *
     * @return void
     */
    public function testAboutPage()
    {
        $response = $this->get('/about');
        $response->assertStatus(200);
    }


}
