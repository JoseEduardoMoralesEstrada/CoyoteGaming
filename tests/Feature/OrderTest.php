<?php

namespace Tests\Feature;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class OrderTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function user_can_complete_a_purchase(): void
    {
        // Arrange
        $user    = User::factory()->create(['role' => 'cliente']);
        $product = Product::factory()->create(['stock' => 10, 'price' => 59.99]);
        $cart    = Cart::create(['user_id' => $user->id]);
        CartItem::create(['cart_id' => $cart->id, 'product_id' => $product->id, 'quantity' => 1]);

        // Act
        $response = $this->actingAs($user)->post(route('checkout.process'));

        // Assert
        $response->assertRedirect();
        $this->assertDatabaseHas('orders', ['user_id' => $user->id, 'status' => 'paid']);
    }

    /** @test */
    public function stock_decreases_after_purchase(): void
    {
        // Arrange
        $user    = User::factory()->create(['role' => 'cliente']);
        $product = Product::factory()->create(['stock' => 10, 'price' => 59.99]);
        $cart    = Cart::create(['user_id' => $user->id]);
        CartItem::create(['cart_id' => $cart->id, 'product_id' => $product->id, 'quantity' => 2]);

        // Act
        $this->actingAs($user)->post(route('checkout.process'));

        // Assert
        $this->assertEquals(8, $product->fresh()->stock);
    }

    /** @test */
    public function guest_cannot_checkout(): void
    {
        // Act
        $response = $this->post(route('checkout.process'));
        // Assert
        $response->assertRedirect('/login');
    }
}