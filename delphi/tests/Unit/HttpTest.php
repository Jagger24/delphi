<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\User;

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


    /**
     * Test login page ('/login')
     *
     * @return void
     */
    public function testLoginPage()
    {
        $response = $this->get('/login');
        $response->assertStatus(200);
    }


    /**
     * Test register page ('/register')
     *
     * @return void
     */
    public function testRegisterPage()
    {
        $response = $this->get('/register');
        $response->assertStatus(200);
    }    

    /**
     * Test home page ('/home')
     *
     * @return void
     */
    public function testUserHomePage()
    {

        $user = factory(User::class)->create();

        $response = $this->actingAs($user)->get('/home');

        $response->assertStatus(200);
    }

    // /**
    //  * Test listView page ('/listView')
    //  *
    //  * @return void
    //  */
    // public function testListViewPage()
    // {
    //     $response = $this->get('/listView');
    //     $response->assertStatus(200);
    // }


    // /**
    //  * Test newGroup page ('/newGroup')
    //  *
    //  * @return void
    //  */
    // public function testNewGroupPage()
    // {
    //     $response = $this->get('/newGroup');
    //     $response->assertStatus(200);
    // }


    // /**
    //  * Test statistics page ('/statistics')
    //  *
    //  * @return void
    //  */
    // public function testStatisticsPage()
    // {
    //     $response = $this->get('/statistics');
    //     $response->assertStatus(200);
    // }


    // /**
    //  * Test stats page ('/stats')
    //  *
    //  * @return void
    //  */
    // public function testStatsPage()
    // {
    //     $response = $this->get('/stats');
    //     $response->assertStatus(200);
    // }


    // /**
    //  * Test totalVoters page ('/totalVoters')
    //  *
    //  * @return void
    //  */
    // public function testTotalVotersPage()
    // {
    //     $response = $this->get('/totalVoters');
    //     $response->assertStatus(200);
    // }


    // /**
    //  * Test waiting page ('/waiting')
    //  *
    //  * @return void
    //  */
    // public function testWaitingPage()
    // {
    //     $response = $this->get('/waiting');
    //     $response->assertStatus(200);
    // }


    /**
     * Test welcome page ('/welcome')
     *
     * @return void
     */
    public function testWelcomePage()
    {
        $response = $this->post('/welcome');
        $response->assertStatus(200);
    }

}
