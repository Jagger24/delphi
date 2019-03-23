<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\User;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RegisterTest extends TestCase
{

    // //use RefreshDatabase;
    // /**
    //  * Test to make sure register for account works.
    //  *
    //  * @return void
    //  */
    // public function testRegisterWorks()
    // {
    //     $user = [
    //         'name' => 'Dante',
    //         'email' => 'Dante.1@osu.edu',
    //         'password'=> bcrypt($password = 'iluvlaravel'),
    //         'password_confirmation'=> bcrypt($password = 'iluvlaravel')];

    //     $response = $this->post('/register', $user);

    //     $response->assertRedirect('/');

    //     // $userInDB = factory(User::class)->make([
    //     //     'name' => 'Dante',
    //     //     'email' => 'Dante.1@osu.edu',
    //     //     'password'=> bcrypt($password = 'iluvlaravel'),]);

    //     array_splice($user, 3);

    //     $this->assertDatabaseHas('users', $user);

    // }

    /**
     * Test to make sure register catches when no name.
     *
     * @return void
     */
    public function testRegisterNotWorkWithEmptyName()
    {
        $user = [
            'name' => '',
            'email' => 'Dante.1@osu.edu',
            'password'=> bcrypt($password = 'iluvlaravel'),
            'password_confirmation'=> bcrypt($password = 'iluvlaravel')];

        $response = $this->post('/register', $user);

        $response->assertSessionHasErrors('name');

    }

    /**
     * Test to make sure register catches when no email.
     *
     * @return void
     */
    public function testRegisterNotWorkWithEmptyEmail()
    {
        $user = [
            'name' => 'Dante',
            'email' => '',
            'password'=> bcrypt($password = 'iluvlaravel'),
            'password_confirmation'=> bcrypt($password = 'iluvlaravel')];

        $response = $this->post('/register', $user);

        $response->assertSessionHasErrors('email');

    }

    /**
     * Test to make sure register catches when no password.
     *
     * @return void
     */
    public function testRegisterNotWorkWithEmptyPassword()
    {
        $user = [
            'name' => 'Dante',
            'email' => 'Dante.1@osu.edu',
            'password'=> '',
            'password_confirmation'=> 'hello'];

        $response = $this->post('/register', $user);

        $response->assertSessionHasErrors('password');

    }


    /**
     * Test to make sure register catches when no password.
     *
     * @return void
     */
    public function testRegisterNotWorkWithPasswordandPasswordConfNoMatch()
    {
        $user = [
            'name' => 'Dante',
            'email' => 'Dante.1@osu.edu',
            'password'=> 'whatsup',
            'password_confirmation'=> 'hello'];

        $response = $this->post('/register', $user);

        $response->assertSessionHasErrors('password');

    }
    

}
