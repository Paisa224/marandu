<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\URL;
use Tests\TestCase;

class EmailVerificationTest extends TestCase
{
    use RefreshDatabase;

    public function test_verification_email_is_sent_upon_registration()
    {
        Notification::fake();
    
        $response = $this->post('/register', [
            'name' => 'Test User',
            'username' => 'testuser',
            'email' => 'testuser@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
        ]);
    
        $user = User::where('email', 'testuser@example.com')->first();
        $this->assertNotNull($user, 'El usuario no fue creado correctamente');
    
        Notification::assertSentTo($user, VerifyEmail::class);
    }
    

    public function test_email_can_be_verified()
    {
        $user = User::factory()->unverified()->create();
    
        $verificationUrl = URL::temporarySignedRoute(
            'verification.verify',
            now()->addMinutes(60),
            ['id' => $user->id, 'hash' => sha1($user->email)]
        );
    
        $response = $this->actingAs($user)->get($verificationUrl);
    
        $response->assertRedirect('/home');
        $this->assertTrue($user->fresh()->hasVerifiedEmail());
    }
    
    public function test_verified_user_cannot_verify_again()
    {
        $user = User::factory()->create(['email_verified_at' => now()]);
    
        $verificationUrl = URL::temporarySignedRoute(
            'verification.verify',
            now()->addMinutes(60),
            ['id' => $user->id, 'hash' => sha1($user->email)]
        );
    
        $response = $this->actingAs($user)->get($verificationUrl);
    
        $response->assertRedirect('/home');
        $this->assertTrue($user->fresh()->hasVerifiedEmail());
    }
}
