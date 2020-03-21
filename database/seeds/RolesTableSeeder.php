<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolesTableSeeder extends Seeder
{
    public function run()
    {
        $roles = [
            \App\Models\Role::KEPALA_LAB => "Kepala Lab",
            \App\Models\Role::STAFF_REGISTRASI =>"Staff Registrasi",
            \App\Models\Role::STAFF_LAB =>"Staff Lab",
        ];

        foreach ($roles as $key => $role) {
            DB::table('roles')->insert([
                'id' => $key,
                'role_name' => $role,
                'role' => $key,
            ]);
        }

        DB::statement("ALTER TABLE roles AUTO_INCREMENT = 4;");
    }
}
