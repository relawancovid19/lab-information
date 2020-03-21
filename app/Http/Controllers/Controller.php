<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use View;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $mainMenu = [
            ['name' => 'dashboard', 'url' => url('/dashboard'), 'label' => 'Dashboard', 'icon' => 'fas fa-tachometer-alt', 'active_in' => ['dashboard'], 'segment_active' => 1, 'has_submenu' => false],
            ['name' => 'registration', 'url' => url('/registration'), 'label' => 'Registrasi', 'icon' => 'fas fa-book-medical', 'active_in' => ['registration'], 'segment_active' => 1, 'has_submenu' => false],
        ];

        View::share('mainMenu', $mainMenu);
    }
}
