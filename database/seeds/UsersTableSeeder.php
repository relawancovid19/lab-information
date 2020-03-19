<?php

use Illuminate\Database\Seeder;

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
            'name' => "Super Admin",
            'username' => 'superadmin',
            'email' => 'admin@relawancovid19.id',
            'email_verified_at' => date('Y-m-d H:i:s'),
            'password' => Hash::make('relawancovid19id'),
        ]);
    }
}
