<?php

namespace App\Http\Controllers;

use App\Http\Requests\SampleReceiveTakingRequest;
use App\Models\SampleReceiveTaking;
use App\Models\SampleType;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class SampleReceiveTakingController extends Controller
{
    /**
     *
     * @return Renderable
     */
    public function index()
    {
        $sampleReceiveTakings = SampleReceiveTaking::all();
        return view('pages.sample_receive_taking.index', [
            "sampleReceiveTakings" => $sampleReceiveTakings,
        ]);
    }

    /**
     *
     * @return Renderable
     */
    public function create()
    {
        $sampleTypes = SampleType::query()->where('is_default', true)->get();
        return view('pages.sample_receive_taking.create', [
            'sampleTypes' => $sampleTypes,
        ]);
    }

    /**
     *
     * @param Request $request
     * @return void
     */
    public function store(Request $request)
    {
        /** @var SampleReceiveTaking $sampleReceiveTaking */
        $sampleReceiveTaking = new SampleReceiveTaking($request->only((new SampleReceiveTaking())->getFillable()));
        $sampleReceiveTaking->save();

        $sampleReceiveTaking->sampleTypes()->sync($request->input('sample_type'));

        return redirect()->route('sample_receive_taking.index');
    }

    /**
     *
     * @param SampleReceiveTaking $sampleReceiveTaking
     *
     * @return Renderable
     */
    public function show(SampleReceiveTaking $sampleReceiveTaking)
    {
        return view('pages.sample_receive_taking.show', [
            'sampleReceiveTaking' => $sampleReceiveTaking,
        ]);
    }

    /**
     *
     * @param SampleReceiveTaking $sampleReceiveTaking
     * @return Renderable
     */
    public function edit(SampleReceiveTaking $sampleReceiveTaking)
    {
        return view('pages.sample_receive_taking.edit', [
            'sampleReceiveTaking' => $sampleReceiveTaking,
        ]);
    }

    /**
     *
     * @param Request $request
     * @param SampleReceiveTaking $sampleReceiveTaking
     * @return Renderable
     */
    public function update(SampleReceiveTakingRequest $request, SampleReceiveTaking $sampleReceiveTaking)
    {
        $sampleReceiveTaking->fill($request->all());

        if($sampleReceiveTaking->isDirty()) {
            $sampleReceiveTaking->save();
        }

        $sampleTypes = $request->input('sample_type');

        $sampleTypes = array_map(function ($sampleType) {
            if(Arr::get($sampleType, "is_done", 0) == 0) {
                $sampleType = [
                    "is_done" => 0,
                ];
            }

            return $sampleType;
        }, $sampleTypes);

        $sampleReceiveTaking->sampleTypes()->sync($sampleTypes);

        return redirect()->route('sample_receive_taking.show', ['sampleReceiveTaking' => $sampleReceiveTaking->getKey()]);
    }
}
