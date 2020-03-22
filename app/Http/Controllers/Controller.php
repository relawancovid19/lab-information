<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Request;
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
            ['name' => 'dashboard', 'url' => url('/dashboard'), 'label' => 'Dashboard', 'icon' => 'fas fa-tachometer-alt', 'active_in' => ['dashboard'], 'segment_active' => 1, 'submenu' => []],
            ['name' => 'sample_receive_taking', 'url' => "#", 'label' => 'Pengambilan / Penerimaan Sampel', 'icon' => 'fas fa-file-signature', 'active_in' => ['Pengambilan Penerimaan Sampel'], 'segment_active' => 1, 'submenu' =>
                [
                    [
                        'name' => 'index', 'url' => url('/sample_receive_taking'),
                        'label' => 'List Data', 'icon' => 'fas fa-file-signature',
                        'active_in' => [''],
                        'segment_active' => 2,
                        'has_submenu' => false,
                        'parent' => 'sample_receive_taking'
                    ],
                    [
                        'name' => 'create', 'url' => url('/sample_receive_taking/create'),
                        'label' => 'Buat Baru', 'icon' => 'fas fa-file-signature',
                        'active_in' => ['create'],
                        'segment_active' => 2,
                        'has_submenu' => false,
                        'parent' => 'sample_receive_taking'
                    ]
                ]
            ],
        ];

        View::share('mainMenu', $mainMenu);
    }
}
