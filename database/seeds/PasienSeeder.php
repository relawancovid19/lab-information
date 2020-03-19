<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class PasienSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('id_ID');

        for ($i=1; $i <= 10; $i++) {
            $gender = $faker->randomElement($array = array ('male', 'female'));
            if($gender == 'male'){
                $jenis_kelamin = 'L';
            }else{
                $jenis_kelamin = 'P';
            }
            DB::table('pasiens')->insert([
    			'nama' => $faker->name($gender),
    			'usia' => $faker->numberBetween(1,99),
    			'alamat' => $faker->address,
    			'jenis_kelamin' => $jenis_kelamin,
    			'telepon' => $faker->phoneNumber,
    			'email' => $faker->unique()->email,
    		]);
        }
    }
}
