<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\User;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LoginTest extends TestCase
{
    /**
     * Tests and make sure user can't user login form when already authenticated.
     *
     * @return void
     */
    public function testUserCantUseLoginFormWhenAuthenticated()
    {
        $user = factory(User::class)->create();

        $response = $this->actingAs($user)->get('/login');

        $response->assertRedirect('/home');
    }

    /**
     * Tests and make sure user can't user login form when already authenticated.
     *
     * @return void
     */
    public function testUserCanLoginWithCorrectCredentials()
    {
        $user = factory(User::class)->create([
            'password'=> bcrypt($password = 'ilovelaravel'),]);

        $response = $this->post('/login', [
            'name' => $user->name,
            'email' => $user->email,
            'password' => $password,]);

        $response->assertRedirect('/home');

        $this->assertAuthenticatedAs($user);
    }


    /**
     * Tests and make sure user can't login with incorrect password.
     * Tests make sure redirected to /login page
     * Tests to make surre name and email are old input.
     * Tests to make sure user is still a guest.
     *
     * @return void
     */
    public function testUserCantLoginWithWrongPassword()
    {
        $user = factory(User::class)->create([
            'password'=> bcrypt($password = 'ilovelaravel'),]);

        $response = $this->from('/login')->post('/login', [
            'name' => $user->name,
            'email' => $user->email,
            'password' => 'wrong-password',]);

        $response->assertRedirect('/login');
        $response->assertSessionHasErrors('email');
        $this->assertTrue(session()->hasOldInput('email'));
        $this->assertTrue(session()->hasOldInput('name'));
        $this->assertFalse(session()->hasOldInput('password'));
        $this->assertGuest();
        
    }

}
