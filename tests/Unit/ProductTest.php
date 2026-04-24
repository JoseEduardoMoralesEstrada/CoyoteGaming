<?php

namespace Tests\Unit;

use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProductTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_requires_a_name(): void
    {
        // Arrange
        $product = Product::factory()->make(['name' => '']);
        // Act
        $isValid = filled($product->name);
        // Assert
        $this->assertFalse($isValid);
    }

    /** @test */
    public function it_belongs_to_a_category(): void
    {
        // Arrange
        $product = Product::factory()->create();
        // Act & Assert
        $this->assertInstanceOf(Category::class, $product->category);
    }

    /** @test */
    public function it_has_a_positive_price(): void
    {
        // Arrange
        $product = Product::factory()->make(['price' => 59.99]);
        // Assert
        $this->assertGreaterThan(0, $product->price);
    }

    /** @test */
    public function it_can_be_out_of_stock(): void
    {
        // Arrange
        $product = Product::factory()->make(['stock' => 0]);
        // Assert
        $this->assertEquals(0, $product->stock);
    }
}