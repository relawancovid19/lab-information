<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => "Petugas Registrasi",
            'username' => 'registrasi',
            'email' => 'regis@relawancovid19.id',
            'email_verified_at' => date('Y-m-d H:i:s'),
            'password' => Hash::make('relawancovid19id'),
            'role_id' => \App\Models\Role::query()->where('name', "petugas registrasi")->first()->id,
        ]);


        DB::table('users')->insert([
            'name' => "Petugas Lab",
            'username' => 'petugas_lab',
            'email' => 'lab@relawancovid19.id',
            'email_verified_at' => date('Y-m-d H:i:s'),
            'password' => Hash::make('relawancovid19id'),
            'role_id' => \App\Models\Role::query()->where('name', "petugas lab")->first()->id,
        ]);


        DB::table('users')->insert([
            'name' => "Kepala Lab",
            'username' => 'kepala_lab',
            'email' => 'kalab@relawancovid19.id',
            'email_verified_at' => date('Y-m-d H:i:s'),
            'password' => Hash::make('relawancovid19id'),
            'role_id' => \App\Models\Role::query()->where('name', "kepala lab")->first()->id,
        ]);
    }
}
