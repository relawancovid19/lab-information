<?php

namespace App\Http\Controllers;


use App\Models\Patient;
use App\Models\Registration;
use App\Models\SampleTypeReceiveTakingPivot;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('pages.dashboard.index', [
            'patient_count' => Patient::count(),
            'registration_count' => Registration::count(),
            'sample_taken_count' => DB::table('sample_type_receive_taking_pivots')->count()
        ]);
    }
}
