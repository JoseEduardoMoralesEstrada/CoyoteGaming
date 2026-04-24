<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class AuthTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_user_can_register(): void
    {
        // Arrange
        $userData = [
            'name'                  => 'Gamer',
            'email'                 => 'gamer@test.com',
            'password'              => 'password',
            'password_confirmation' => 'password',
        ];
        // Act
        $response = $this->post('/register', $userData);
        // Assert
        $response->assertRedirect('/');
    }

    /** @test */
    public function a_user_can_login(): void
    {
        // Arrange
        $user = User::factory()->create(['password' => Hash::make('password')]);
        // Act
        $response = $this->post('/login', [
            'email'    => $user->email,
            'password' => 'password',
        ]);
        // Assert
        $response->assertRedirect('/');
    }

    /** @test */
    public function cliente_cannot_access_admin_dashboard(): void
    {
        // Arrange
        $cliente = User::factory()->create(['role' => 'cliente']);
        // Act
        $response = $this->actingAs($cliente)->get('/admin/dashboard');
        // Assert
        $response->assertStatus(403);
    }

    /** @test */
    public function admin_can_access_dashboard(): void
    {
        // Arrange
        $admin = User::factory()->create(['role' => 'admin']);
        // Act
        $response = $this->actingAs($admin)->get('/admin/dashboard');
        // Assert
        $response->assertStatus(200);
    }
}