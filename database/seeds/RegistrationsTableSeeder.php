<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class RegistrationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('registrations')->insert([
            'registration_number' => '20200321000001',
            'sample_number' => 'L1QWERTY',
            'dinkes_sender' => 'Dinkes 1',
            'fasyankes_sender' => 'Puskesmas 1',
            'fasyankes_phone' => '0123456789',
            'doctor' => 'dr. Covid',
            'registration_date' => Carbon::now()->format('Y-m-d'),
            'reference_number' => 'ABC123',
            'patient_id' => 1,
        ]);
    }
}
