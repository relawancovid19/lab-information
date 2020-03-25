<?php

namespace App\Http\Controllers;

use App\Models\SampleReceivePcr;
use App\Models\Registration;
use Illuminate\Http\Request;
use Carbon\Carbon;

class SampleReceivePcrController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sampleReceivePcrs = SampleReceivePcr::all();
        return view('pages.sample_receive_pcr.index', [
            "sampleReceivePcrs" => $sampleReceivePcrs,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $registrations = Registration::query()->get();
        return view('pages.sample_receive_pcr.create', [
            'registrations' => $registrations,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        /** @var SampleReceivePcr $sampleReceivePcr */
        $data = [];
        $data = $request->only((new SampleReceivePcr())->getFillable());
        $data['rna_datetime'] = Carbon::createFromFormat('d/m/Y', $request->input('rna_date'))->format('Y-m-d') . ' ' . $request->input('rna_time');
        $data['check_start_datetime'] = Carbon::createFromFormat('d/m/Y', $request->input('check_start_date'))->format('Y-m-d') . ' ' . $request->input('check_start_time');
        $data['check_finish_datetime'] = Carbon::createFromFormat('d/m/Y', $request->input('check_finish_date'))->format('Y-m-d') . ' ' . $request->input('check_finish_time');
        $data['from_lab'] = $request->input('from_lab') == 'lainnya' ? $request->input('from_lab_other') : $request->input('from_lab');

        $sampleReceivePcr = new SampleReceivePcr($data);
        $sampleReceivePcr->save();

        return redirect()->route('sample_receive_pcr.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SampleReceivePcr  $sampleReceivePcr
     * @return \Illuminate\Http\Response
     */
    public function show(SampleReceivePcr $sampleReceivePcr)
    {
        return view('pages.sample_receive_pcr.show', [
            'sampleReceivePcr' => $sampleReceivePcr,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SampleReceivePcr  $sampleReceivePcr
     * @return \Illuminate\Http\Response
     */
    public function edit(SampleReceivePcr $sampleReceivePcr)
    {
        return view('pages.sample_receive_pcr.edit', [
            'sampleReceivePcr' => $sampleReceivePcr,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SampleReceivePcr  $sampleReceivePcr
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SampleReceivePcr $sampleReceivePcr)
    {
        $data = [];
        $data = $request->only((new SampleReceivePcr())->getFillable());
        $data['rna_datetime'] = Carbon::createFromFormat('d/m/Y', $request->input('rna_date'))->format('Y-m-d') . ' ' . $request->input('rna_time');
        $data['check_start_datetime'] = Carbon::createFromFormat('d/m/Y', $request->input('check_start_date'))->format('Y-m-d') . ' ' . $request->input('check_start_time');
        $data['check_finish_datetime'] = Carbon::createFromFormat('d/m/Y', $request->input('check_finish_date'))->format('Y-m-d') . ' ' . $request->input('check_finish_time');
        $data['from_lab'] = $request->input('from_lab') == 'lainnya' ? $request->input('from_lab_other') : $request->input('from_lab');

        $sampleReceivePcr->fill($data);

        if ($sampleReceivePcr->isDirty()) {
            $sampleReceivePcr->save();
        }

        return redirect()->route('sample_receive_pcr.show', ['sampleReceivePcr' => $sampleReceivePcr->getKey()]);
    }
}
