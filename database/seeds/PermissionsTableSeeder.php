<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Route;
use App\Models\Permission;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $routes = Route::getRoutes();

        foreach ($routes as $route) {
            $isAuth = in_array('auth', $route->action['middleware']);
            $name = $route->action['as'] ?? null;
            if ($isAuth && !empty($name)) {
                Permission::firstOrCreate(['name' => $name]);
            }
        }
    }
}
