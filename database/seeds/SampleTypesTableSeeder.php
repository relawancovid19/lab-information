<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class SampleTypesTableSeeder extends Seeder
{
    public function run()
    {
        $samples = [
            "Usap Nasofarig",
            "Usap Orofarig",
            "Sputum",
            "Bronchoalveolar Lavage",
            "Tracheal Aspirate",
            "Nasal Wash",
            "Jaringan Biopsi/Otopsi",
            "Serum Akut (<7 Hari Demam)",
            "Serum Konvalesen (2-3 Minggu Demam)",
        ];

        foreach ($samples as $sample) {
            DB::table('sample_types')->insert([
                'sample_name' => $sample,
                'slug_sample_name' => Str::slug($sample),
                'is_default' => true,
            ]);
        }
    }
}
