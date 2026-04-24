<?php
namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use App\Models\Tag;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $tags = [
            'Multijugador', 'Historia', 'Mundo Abierto',
            'Cooperativo', 'Competitivo', 'Indie', 'AAA', 'Retro'
        ];

        foreach ($tags as $tag) {
            Tag::create([
                'name' => $tag,
                'slug' => Str::slug($tag),
            ]);
        }

        $products = [
            ['name' => 'God of War Ragnarok', 'category' => 'Acción', 'platform' => 'PS5', 'price' => 69.99, 'stock' => 25, 'genre' => 'Acción'],
            ['name' => 'Elden Ring', 'category' => 'RPG', 'platform' => 'PC', 'price' => 59.99, 'stock' => 30, 'genre' => 'RPG'],
            ['name' => 'FIFA 25', 'category' => 'Deportes', 'platform' => 'PS5', 'price' => 49.99, 'stock' => 50, 'genre' => 'Deportes'],
            ['name' => 'Halo Infinite', 'category' => 'Acción', 'platform' => 'Xbox Series X', 'price' => 39.99, 'stock' => 20, 'genre' => 'Acción'],
            ['name' => 'The Legend of Zelda', 'category' => 'Aventura', 'platform' => 'Nintendo Switch', 'price' => 59.99, 'stock' => 15, 'genre' => 'Aventura'],
            ['name' => 'Resident Evil 4', 'category' => 'Terror', 'platform' => 'PC', 'price' => 49.99, 'stock' => 10, 'genre' => 'Terror'],
            ['name' => 'Age of Empires IV', 'category' => 'Estrategia', 'platform' => 'PC', 'price' => 44.99, 'stock' => 40, 'genre' => 'Estrategia'],
            ['name' => 'Spider-Man 2', 'category' => 'Acción', 'platform' => 'PS5', 'price' => 69.99, 'stock' => 35, 'genre' => 'Acción'],
        ];

        foreach ($products as $data) {
            $category = Category::where('name', $data['category'])->first();
            $product = Product::create([
                'category_id' => $category->id,
                'name' => $data['name'],
                'slug' => Str::slug($data['name']),
                'description' => 'Descripción de ' . $data['name'],
                'price' => $data['price'],
                'stock' => $data['stock'],
                'platform' => $data['platform'],
                'genre' => $data['genre'],
                'sales_count' => rand(0, 500),
            ]);

            $randomTags = Tag::inRandomOrder()->limit(3)->get();
            $product->tags()->attach($randomTags);
        }
    }
}