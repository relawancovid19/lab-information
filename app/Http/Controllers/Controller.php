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
     */
    public function __construct()
    {
        $mainMenu = [
            ['name' => 'dashboard', 'url' => url('/dashboard'), 'label' => 'Dashboard', 'icon' => 'fas fa-tachometer-alt', 'active_in' => ['dashboard'], 'segment_active' => 1, 'submenu' => []],
            ['name' => 'registration', 'url' => '', 'label' => 'Registrasi', 'icon' => 'fas fa-book-medical', 'active_in' => ['registrations'], 'segment_active' => 1, 'submenu' =>
                [
                    [
                        'name' => 'all_registration',
                        'url' => url('/registrations'),
                        'label' => 'Data Registrasi', 'icon' => '',
                        'active_in' => [''],
                        'segment_active' => 2,
                        'has_submenu' => false,
                        'parent' => 'registration'
                    ],
                    [
                        'name' => 'new_registration',
                        'url' => url('/registrations/create'),
                        'label' => 'Registrasi Baru', 'icon' => '',
                        'active_in' => ['create'],
                        'segment_active' => 2,
                        'has_submenu' => false,
                        'parent' => 'registration'
                    ],
                ]
            ],
            ['name' => 'sample_receive_taking', 'url' => "#", 'label' => 'Sampel', 'icon' => 'fas fa-file-signature', 'active_in' => ['sample_receive_taking'], 'segment_active' => 1, 'submenu' =>
                [
                    [
                        'name' => 'index', 'url' => url('/sample_receive_taking'),
                        'label' => 'Data Sampel', 'icon' => 'fas fa-file-signature',
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
            ['name' => 'sample_receive_pcr', 'url' => "#", 'label' => 'PCR', 'icon' => 'fas fa-file-signature', 'active_in' => ['sample_receive_pcr'], 'segment_active' => 1, 'submenu' =>
                [
                    [
                        'name' => 'index', 'url' => url('/sample_receive_pcr'),
                        'label' => 'Data Sampel PCR', 'icon' => 'fas fa-file-signature',
                        'active_in' => [''],
                        'segment_active' => 2,
                        'has_submenu' => false,
                        'parent' => 'sample_receive_pcr'
                    ],
                    [
                        'name' => 'create', 'url' => url('/sample_receive_pcr/create'),
                        'label' => 'Buat Baru Sampel PCR', 'icon' => 'fas fa-file-signature',
                        'active_in' => ['create'],
                        'segment_active' => 2,
                        'has_submenu' => false,
                        'parent' => 'sample_receive_pcr'
            ['name' => 'rna', 'url' => "#", 'label' => 'Ekstraksi RNA', 'icon' => 'fas fa-vials', 'active_in' => ['rna'], 'segment_active' => 1, 'submenu' =>
                [
                    [
                        'name' => 'index', 'url' => url('/rna'),
                        'label' => 'Data RNA', 'icon' => 'fas fa-file-signature',
                        'active_in' => [''],
                        'segment_active' => 2,
                        'has_submenu' => false,
                        'parent' => 'rna'
                    ],
                    [
                        'name' => 'create', 'url' => url('/rna/create'),
                        'label' => 'Buat Baru', 'icon' => 'fas fa-file-signature',
                        'active_in' => ['create'],
                        'segment_active' => 2,
                        'has_submenu' => false,
                        'parent' => 'rna'
                    ]
                ]
            ],
        ];

        View::share('mainMenu', $mainMenu);
    }
}
