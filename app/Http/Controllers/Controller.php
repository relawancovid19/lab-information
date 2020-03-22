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
            ['name' => 'registration', 'url' => '', 'label' => 'Registrasi', 'icon' => 'fas fa-book-medical', 'active_in' => ['registrations'], 'segment_active' => 1, 'has_submenu' => true],
        ];

        $subMenu = [
            // REGISTRATION
            ['name' => 'all_registration', 'url' => url('/registrations'), 'label' => 'Data Registrasi', 'icon' => '', 'active_in' => ['registrations'], 'not_active' => ['registrations/create'], 'parent' => 'registration'],
            ['name' => 'new_registration', 'url' => url('/registrations/create'), 'label' => 'Registrasi Baru', 'icon' => '', 'active_in' => ['registrations/create'], 'not_active' => '', 'parent' => 'registration'],
        ];

        View::share('mainMenu', $mainMenu);
        View::share('subMenu', $subMenu);
    }
}
