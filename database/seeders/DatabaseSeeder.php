<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1) Crear un profesor/admin por defecto (solo si no existe)
        if (! User::where('email', 'profesor@utn.local')->exists()) {
            User::create([
                // 'nombres' y 'apellidos' como arreglo si tu migration/Model los maneja como JSON/array
                'nombres' => ['Profesor'],
                'apellidos' => ['Admin'],
                'email' => 'profesor@utn.local',
                // Hasheamos explícitamente para evitar depender del cast
                'password' => Hash::make('secret123'),
                'rol' => 'profesor',
                'telefono' => null,
                'foto_perfil' => null,
            ]);
        }

        // 2) Crear un usuario de prueba concreto (Test User) con email fijo
        // Usamos la factory pero pasamos nombres/apellidos correctos (arrays)
        User::factory()->create([
            'nombres' => ['Test'],
            'apellidos' => ['User'],
            'email' => 'test@example.com',
            // Si tu modelo tiene 'password' => 'hashed' podés pasar 'password' => 'password'
            // pero aquí lo dejamos para que sea consistente:
            'password' => Hash::make('password'),
            'rol' => 'alumno',
        ]);

        // 3) Crear otros usuarios de ejemplo (9 más), usando la factory por defecto
        User::factory(9)->create();
    }
}
