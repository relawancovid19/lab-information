<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            RolesTableSeeder::class,
            UsersTableSeeder::class,
            PatientsTableSeeder::class,
            RegistrationsTableSeeder::class,
            SymptomsTableSeeder::class,
            SampleTypesTableSeeder::class,
        ]);
    }
}
