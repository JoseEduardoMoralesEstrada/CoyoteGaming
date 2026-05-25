<?php
namespace Database\Seeders;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        // 2 Administradores
        User::create([
            'name' => 'Administrador 1',
            'email' => 'admin@coyotegaming.com',
            'password' => Hash::make('Admin1234@'),
            'role' => 'admin',
            'email_verified_at' => now(),
        ]);
        User::create([
            'name' => 'Administrador 2',
            'email' => 'admin2@coyotegaming.com',
            'password' => Hash::make('Admin1234@'),
            'role' => 'admin',
            'email_verified_at' => now(),
        ]);

        // 4 Clientes
        User::create([
            'name' => 'Cliente 1',
            'email' => 'cliente1@coyotegaming.com',
            'password' => Hash::make('Cl13nt3004@'),
            'role' => 'cliente',
            'email_verified_at' => now(),
        ]);
        User::create([
            'name' => 'Cliente 2',
            'email' => 'cliente2@coyotegaming.com',
            'password' => Hash::make('Cl13nt3004@'),
            'role' => 'cliente',
            'email_verified_at' => now(),
        ]);
        User::create([
            'name' => 'Cliente 3',
            'email' => 'cliente3@coyotegaming.com',
            'password' => Hash::make('Cl13nt3004@'),
            'role' => 'cliente',
            'email_verified_at' => now(),
        ]);
        User::create([
            'name' => 'Cliente 4',
            'email' => 'cliente4@coyotegaming.com',
            'password' => Hash::make('Cl13nt3004@'),
            'role' => 'cliente',
            'email_verified_at' => now(),
        ]);
    }
}