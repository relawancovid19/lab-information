<?php

use Illuminate\Database\Seeder;

class PatientsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('patients')->insert([
            'nik' => '1234567890',
            'fullname' => 'Pasien Demo',
            'date_of_birth' => '1990-01-01',
            'age_year' => 30,
            'age_month' => 0,
            'gender' => 'Laki-laki',
            'address_1' => 'Jalan Lurus No. 1 RT.001 / RW. 001',
            'address_2' => 'Kelurahan Lurus Aja, Kecamatan Lurus Terus, Jakarta Selatan',
            'phone_number' => '080989999',
        ]);
    }
}
