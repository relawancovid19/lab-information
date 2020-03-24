<?php

namespace App\Http\Controllers;

use App\Models\Rna;

class RnaController extends Controller {

    public function index()
    {
        $sampleReceiveTakings = Rna::all();
        return view('pages.sample_receive_taking.index', [
            "sampleReceiveTakings" => $sampleReceiveTakings,
        ]);
    }
}
