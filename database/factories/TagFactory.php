<?php
namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class TagFactory extends Factory
{
    public function definition(): array
    {
        $tags = ['Multijugador', 'Historia', 'Mundo Abierto', 'Cooperativo', 'Competitivo', 'Indie', 'AAA', 'Retro'];
        $name = $this->faker->unique()->randomElement($tags);
        return [
            'name' => $name,
            'slug' => Str::slug($name),
        ];
    }
}