<?php

use Illuminate\Database\Seeder;

class RoleUserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = \App\Models\User::with('role')->get();

        foreach ($users as $user) {
            $user->roles()->sync(['role_id' => $user->role->id]);
        }
    }
}
