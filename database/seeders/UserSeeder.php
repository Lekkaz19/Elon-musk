<?php
namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $adminRole = Role::where('name', 'admin')->first();
        $userRole = Role::where('name', 'user')->first();

        // 1. Usuario Administrador (email: admin@elon.com, pass: password)
        User::create([
            'name' => 'Admin Elon Musk',
            'email' => 'admin@elon.com',
            'password' => Hash::make('password'),
            'role_id' => $adminRole->id ?? 1,
            'is_active' => true,
        ]);

        // 2. Usuario Registrado de Prueba
        User::create([
            'name' => 'Usuario Prueba',
            'email' => 'user@elon.com',
            'password' => Hash::make('password'),
            'role_id' => $userRole->id ?? 2,
            'is_active' => true,
        ]);
    }
}