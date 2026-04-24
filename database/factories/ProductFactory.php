<?php
namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ProductFactory extends Factory
{
    public function definition(): array
    {
        $games = [
            'Shadow Legends', 'Cyber Quest', 'Dragon Storm', 'Space Warriors',
            'Neon Fighters', 'Dark Souls Chronicles', 'Galaxy Riders', 'Pixel Heroes',
            'Thunder Strike', 'Mystic Realms', 'Iron Fortress', 'Ocean Depths',
            'Sky Hunters', 'Zombie Apocalypse', 'Racing Fever', 'Football Kings'
        ];
        $name = $this->faker->unique()->randomElement($games);
        return [
            'category_id' => Category::factory(),
            'name' => $name,
            'slug' => Str::slug($name) . '-' . $this->faker->unique()->numberBetween(1, 9999),
            'description' => $this->faker->paragraph(),
            'price' => $this->faker->randomFloat(2, 9.99, 79.99),
            'stock' => $this->faker->numberBetween(0, 100),
            'platform' => $this->faker->randomElement(['PC', 'PS5', 'Xbox Series X', 'Nintendo Switch']),
            'genre' => $this->faker->randomElement(['Acción', 'RPG', 'Aventura', 'Deportes', 'Terror']),
            'sales_count' => $this->faker->numberBetween(0, 500),
        ];
    }
}