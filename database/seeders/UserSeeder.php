<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = User::updateOrCreate(
            ['email' => 'andres17cc95@gmail.com'],
            [
                'name' => 'Andres Castillo',
                'password' => bcrypt('12345678'),
                'id_number' => '1234567890',
                'phone' => '9999302912',
                'address' => 'Calle 123, Colonia 2',
            ]
        );
        $doctor = User::updateOrCreate(
            ['email' => 'marco@test.com'],
            [
                'name' => 'Marco Lopez',
                'password' => bcrypt('12345678'),
                'id_number' => '1234567891',
                'phone' => '9958746523',
                'address' => 'Calle 135, Colonia 1',
            ]
        );
        $recepcionits = User::updateOrCreate(
            ['email' => 'martha@test.com'],
            [
                'name' => 'Martha Diaz',
                'password' => bcrypt('12345678'),
                'id_number' => '1234567892',
                'phone' => '548932462',
                'address' => 'Calle 143, Colonia 5',
            ]
        );

        // Asignar el rol (sincronizar para asegurar que solo tenga este rol)
        $admin->syncRoles(['Administrador']);
        $doctor->syncRoles(['Doctor']);
        $recepcionits->syncRoles(['Recepcionista']);
    }
}
