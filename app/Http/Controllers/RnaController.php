<?php

namespace App\Http\Controllers;

use App\Models\Rna;
use App\Models\Registration;
use Illuminate\Http\Request;
use App\Models\SampleReceiveTaking;

class RnaController extends Controller {

    public function index()
    {
        $rnas = Rna::all();

        return view('pages.rna.index', [
            "rnas" => $rnas,
        ]);
    }

    /**
     *
     * @return Renderable
     */
    public function create()
    {
        $registrationNumbers = Registration::all();
        $sampleReceiveTakings = SampleReceiveTaking::all();

        return view('pages.rna.create', [
            'registrationNumbers' => $registrationNumbers,
            "sampleReceiveTakings" => $sampleReceiveTakings,
        ]);
    }

    public function store(Request $request)
    {
        $rna = new Rna($request->only((new Rna())->getFillable()));
        $rna->save();

        return redirect()->route('rna.index');
    }
}
