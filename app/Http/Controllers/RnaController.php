<?php

namespace App\Http\Controllers;

use App\Models\Rna;
use App\Models\Registration;
use Illuminate\Http\Request;
use App\Models\SampleReceiveTaking;

class RnaController extends Controller
{

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

    public function show(Rna $rna)
    {
        return view('pages.rna.show', [
            'rna' => $rna,
        ]);
    }

    public function edit(Rna $rna)
    {
        $registrationNumbers = Registration::all();
        $sampleReceiveTakings = SampleReceiveTaking::all();

        return view('pages.rna.edit', [
            'rna' => $rna,
            "sampleReceiveTakings" => $sampleReceiveTakings,
            'registrationNumbers' => $registrationNumbers,
        ]);
    }

    public function update(Request $request, Rna $rna)
    {
        $rna->fill($request->all());

        if ($rna->isDirty()) {
            $rna->save();
        }

        return redirect()->route('rna.show', ['rna' => $rna->getKey()]);
    }
}
