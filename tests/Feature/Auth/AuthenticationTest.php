<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class AuthenticationTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * Test login with valid username and password.
     *
     * @return void
     */
    public function test_user_can_login_with_valid_credentials()
    {
        // Create a user
        $user = User::factory()->create([
            'username' => 'testuser',
            'password' => bcrypt($password = 'password'),
        ]);

        // Attempt to login
        $response = $this->post('/login', [
            'username' => 'testuser',
            'password' => $password,
        ]);

        // Assert the login was successful
        $response->assertStatus(302);
        $this->assertAuthenticatedAs($user);
    }

    /**
     * Test login with invalid username.
     *
     * @return void
     */
    public function test_user_cannot_login_with_invalid_username()
    {
        // Attempt to login with an invalid username
        $response = $this->post('/login', [
            'username' => 'invaliduser',
            'password' => 'password',
        ]);

        // Assert the login failed
        $response->assertStatus(302);
        $response->assertSessionHasErrors(); // Verifica cualquier error en la sesión
        $this->assertGuest();
    }

    /**
     * Test login with invalid password.
     *
     * @return void
     */
    public function test_user_cannot_login_with_invalid_password()
    {
        // Create a user
        $user = User::factory()->create([
            'username' => 'testuser',
            'password' => bcrypt('password'),
        ]);

        // Attempt to login with an invalid password
        $response = $this->post('/login', [
            'username' => 'testuser',
            'password' => 'invalidpassword',
        ]);

        // Assert the login failed
        $response->assertStatus(302);
        $response->assertSessionHasErrors(); // Verifica cualquier error en la sesión
        $this->assertGuest();
    }
}
