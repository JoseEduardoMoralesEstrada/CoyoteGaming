<?php
namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Administrador',
            'email' => 'admin@coyotegaming.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
            'email_verified_at' => now(),
        ]);

        User::create([
            'name' => 'Cliente Demo',
            'email' => 'cliente@coyotegaming.com',
            'password' => Hash::make('password'),
            'role' => 'cliente',
            'email_verified_at' => now(),
        ]);
    }
}