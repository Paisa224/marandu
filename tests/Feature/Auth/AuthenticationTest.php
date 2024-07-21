<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Tests\TestCase;

class AuthenticationTest extends TestCase
{
    use RefreshDatabase;

    public function test_users_can_authenticate_using_the_login_screen(): void
    {
        // Confirmar que la columna 'username' existe
        $this->assertTrue(Schema::hasColumn('users', 'username'), 'La tabla users no tiene la columna username');

        $user = User::factory()->create([
            'username' => 'testuser',
            'password' => Hash::make('password'),
        ]);

        $credentials = [
            'username' => 'testuser',
            'password' => 'password',
        ];

        // Verificar que el usuario se creó correctamente y que la contraseña está encriptada
        $this->assertDatabaseHas('users', ['username' => 'testuser']);
        $this->assertTrue(Hash::check('password', $user->password), 'La contraseña no coincide');

        // Añadir depuración para verificar los datos de la solicitud
        Log::info('Test de Autenticación - Credenciales:', $credentials);

        try {
            $response = $this->post('/login', $credentials);
            Log::info('Respuesta de Autenticación:', ['content' => $response->getContent(), 'status' => $response->status()]);
        } catch (\Exception $e) {
            Log::error('Error durante el intento de login: ' . $e->getMessage(), ['exception' => $e]);
            dd($e->getMessage());
        }

        // Verificar la respuesta de la solicitud de login
        $response->assertStatus(302);
        $response->assertRedirect(route('home'));

        $this->assertAuthenticated();
    }
}
