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
            'role_id' => \App\Models\Role::STAFF_REGISTRASI,
        ]);

        DB::table('users')->insert([
            'name' => "dr. Respati",
            'username' => 'dokter_alit',
            'email' => 'respati@relawancovid19.id',
            'email_verified_at' => date('Y-m-d H:i:s'),
            'password' => Hash::make('relawancovid19id'),
            'role_id' => \App\Models\Role::STAFF_REGISTRASI,
        ]);

        DB::table('users')->insert([
            'name' => "dr. Vita",
            'username' => 'dokter_vita',
            'email' => 'vita@relawancovid19.id',
            'email_verified_at' => date('Y-m-d H:i:s'),
            'password' => Hash::make('relawancovid19id'),
            'role_id' => \App\Models\Role::STAFF_REGISTRASI,
        ]);

        DB::table('users')->insert([
            'name' => "Petugas Lab",
            'username' => 'petugas_lab',
            'email' => 'lab@relawancovid19.id',
            'email_verified_at' => date('Y-m-d H:i:s'),
            'password' => Hash::make('relawancovid19id'),
            'role_id' => \App\Models\Role::STAFF_LAB,
        ]);


        DB::table('users')->insert([
            'name' => "Kepala Lab",
            'username' => 'kepala_lab',
            'email' => 'kalab@relawancovid19.id',
            'email_verified_at' => date('Y-m-d H:i:s'),
            'password' => Hash::make('relawancovid19id'),
            'role_id' => \App\Models\Role::KEPALA_LAB,
        ]);
    }
}
