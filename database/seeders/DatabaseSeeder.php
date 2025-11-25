<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        //Llamar a RoleSeeder and base data
        $this->call([
            RoleSeeder::class,
            UserSeeder::class,
            PatientsSeeder::class,
            TreatmentsSeeder::class,
            AppointmentsSeeder::class,
        ]);
        // User::factory(10)->create();

    }
}
