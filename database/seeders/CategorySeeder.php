<?php
namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['name' => 'Acción', 'description' => 'Juegos de acción y aventura'],
            ['name' => 'RPG', 'description' => 'Juegos de rol y fantasía'],
            ['name' => 'Deportes', 'description' => 'Juegos deportivos'],
            ['name' => 'Estrategia', 'description' => 'Juegos de estrategia y táctica'],
            ['name' => 'Terror', 'description' => 'Juegos de terror y supervivencia'],
            ['name' => 'Aventura', 'description' => 'Juegos de aventura y exploración'],
        ];

        foreach ($categories as $category) {
            Category::create([
                'name' => $category['name'],
                'slug' => Str::slug($category['name']),
                'description' => $category['description'],
            ]);
        }
    }
}
