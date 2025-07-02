<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name'     => 'Administrador',
            'email'    => 'admin@admin.com',
            'password' => Hash::make('12345678'),
            'active'   => true,
        ]);

        $usuarios = [
            [
                'name'     => 'Carlos García',
                'email'    => 'carlos@correo.com',
                'password' => Hash::make('12345678'),
                'active'   => true,
            ],
            [
                'name'     => 'Ana López',
                'email'    => 'ana@correo.com',
                'password' => Hash::make('12345678'),
                'active'   => true,
            ],
            [
                'name'     => 'Luis Pérez',
                'email'    => 'luis@correo.com',
                'password' => Hash::make('12345678'),
                'active'   => false,
            ],
            [
                'name'     => 'Mariana Díaz',
                'email'    => 'mariana@correo.com',
                'password' => Hash::make('12345678'),
                'active'   => true,
            ],
        ];
        
        foreach ($usuarios as $usuario) {
            User::create($usuario);
        }
    }
}
