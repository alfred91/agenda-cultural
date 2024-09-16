<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Company;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1 Usuario fijo para cada rol
        $fixedUsers = [
            [
                'dni' => '00000000X',
                'name' => 'Admin',
                'surname' => 'Admin',
                'age' => 32,
                'email' => 'admin@gmail.com',
                'password' => Hash::make('12345678'),
                'address' => 'Admin Address',
                'city' => 'Liberty City',
                'phone' => '600100200',
                'role' => 'administrador',
            ],
            [
                'dni' => '11111111X',
                'name' => 'Asistente',
                'surname' => 'User',
                'age' => 25,
                'email' => 'asistente@gmail.com',
                'password' => Hash::make('12345678'),
                'address' => 'User Address',
                'city' => 'Asistente City',
                'phone' => '600300400',
                'role' => 'asistente',
            ]
        ];

        foreach ($fixedUsers as $user) {
            User::create($user);
        }

        if (Company::count() > 0) {
            $company_id = Company::inRandomOrder()->first()->id;

            User::create([
                'dni' => '22222222X',
                'name' => 'Creador',
                'surname' => 'Eventos',
                'age' => 40,
                'email' => 'creador@gmail.com',
                'password' => Hash::make('12345678'),
                'address' => 'Creador Address',
                'city' => 'Creador City',
                'phone' => '600500600',
                'role' => 'creador_eventos',
                'company_id' => $company_id,
                'position' => 'Event_Manager',
            ]);
        }

        // 20 usuarios de prueba
        User::factory()->count(20)->create();
    }
}
