<?php

namespace Tests\Feature;

use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CartTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function authenticated_user_can_add_product_to_cart(): void
    {
        // Arrange
        $user    = User::factory()->create(['role' => 'cliente']);
        $product = Product::factory()->create(['stock' => 10]);
        // Act
        $response = $this->actingAs($user)
            ->post(route('cart.add', $product));
        // Assert
        $response->assertRedirect();
    }

    /** @test */
    public function guest_cannot_add_to_cart(): void
    {
        // Arrange
        $product = Product::factory()->create(['stock' => 5]);
        // Act
        $response = $this->post(route('cart.add', $product));
        // Assert
        $response->assertRedirect('/login');
    }

    /** @test */
    public function user_can_view_their_cart(): void
    {
        // Arrange
        $user = User::factory()->create(['role' => 'cliente']);
        // Act
        $response = $this->actingAs($user)->get(route('cart.index'));
        // Assert
        $response->assertStatus(200);
    }
}