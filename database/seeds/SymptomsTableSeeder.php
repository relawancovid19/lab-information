<?php

use Illuminate\Database\Seeder;

class SymptomsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('symptoms')->insert([
            'fever' => true,
            'cough' => true,
            'sore_throat' => true,
            'shortness_of_breath' => true,
            'flu' => true,
            'fatigue' => true,
            'headache' => true,
            'diarrhea' => true,
            'nausea_or_vomiting' => true,
            'comorbid' => true,
            'comorbid_description' => 'Asma',
            'other_symptoms' => 'Diabetes',
            'pulmonary_xray' => 1,
            'using_ventilator' => true,
            'registration_id' => 1
        ]);
    }
}
