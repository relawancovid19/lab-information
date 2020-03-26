<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RapidDiagnosticTest;
use App\Models\Patient;
use App\Models\Registration;

class RDTController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['key'] = 0;
        $data['list'] = RapidDiagnosticTest::with('patient')->get();
        $data['convert'] = function($value){
            switch ($value) {
                case 'negative':
                    return 'Negatif';
                    break;

                case 'positive':
                    return 'Positif';
                    break;

                case 'unknown':
                    return 'Tidak dapat ditentukan';
                    break;
                
                default:
                    return $value;
                    break;
            }
        };
        return view('pages.rdt_recording.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.rdt_recording.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $post = $request->post();
        if($post['id_type'] == 'nik'){
            $patient_id = Patient::select('id')->where('nik',$post['registration_number'])->pluck('id')->first();
        }else{
            $patient_id = Registration::select('patient_id')->where('registration_number',$post['registration_number'])->pluck('patient_id')->first();
        }
        if(!$patient_id){
            return back()->withInput()->withErrors(['Data pasien tidak ditemukan']);
        }
        $insert = [
            'patient_id' => $patient_id,
            'date_fever_first' => date('Y-m-d H:i:s',strtotime($request->post('date_fever_first'))),
            'first_test_date' => date('Y-m-d H:i:s',strtotime($request->post('first_test_date').' '.$request->post('first_test_time'))),
            'first_serum_sample_number' => $request->post('first_serum_sample_number'),
            'first_whole_blood_sample_number' => $request->post('first_whole_blood_sample_number'),
            'first_serum_result' => $request->post('first_serum_result'),
            'first_whole_blood_result' => $request->post('first_whole_blood_result'),
            'first_analyst' => $request->post('first_analyst'),
            'first_notes' => $request->post('first_notes'),
            'second_test_date' => date('Y-m-d H:i:s',strtotime($request->post('second_test_date').' '.$request->post('second_test_time'))),
            'second_serum_sample_number' => $request->post('second_serum_sample_number'),
            'second_whole_blood_sample_number' => $request->post('second_whole_blood_sample_number'),
            'second_serum_result' => $request->post('second_serum_result'),
            'second_whole_blood_result' => $request->post('second_whole_blood_result'),
            'second_analyst' => $request->post('second_analyst'),
            'second_notes' => $request->post('second_notes')
        ];
        $create = RapidDiagnosticTest::create($insert);
        if(!$create){
            return $create;
            return back()->withInput()->withErrors(['Gagal menyimpan data']);
        }else{
            return redirect(route('rdt_recording.show',$create->id))->with('success',['Berhasil menyimpan data']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(RapidDiagnosticTest $rdt_recording)
    {
        $rdt_recording->load('patient');
        $data['data'] = $rdt_recording;
        return view('pages.rdt_recording.show',$data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(RapidDiagnosticTest $rdt_recording)
    {
        $data['data'] = $rdt_recording;
        return view('pages.rdt_recording.edit',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, RapidDiagnosticTest $rdt_recording)
    {
        $update = $request->except(['_token','_method']);
        $update['date_fever_first'] = date('Y-m-d H:i:s',strtotime($request->post('date_fever_first')));
        $update['first_test_date'] = date('Y-m-d H:i:s',strtotime($request->post('first_test_date').' '.$request->post('first_test_time')));
        $update['second_test_date'] = date('Y-m-d H:i:s',strtotime($request->post('second_test_date').' '.$request->post('second_test_time')));
        $update['first_serum_sample_number'] = $request->post('first_serum_sample_number');
        $update['first_whole_blood_sample_number'] = $request->post('first_whole_blood_sample_number');
        $update['second_serum_sample_number'] = $request->post('second_serum_sample_number');
        $update['second_whole_blood_sample_number'] = $request->post('second_whole_blood_sample_number');
        $do = $rdt_recording->update($update);
        if($do){
            return redirect(route('rdt_recording.show',$rdt_recording->id))->with('success',['Berhasil memperbarui']);
        }else{
            return back()->withErrors(['Gagal memperbarui']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(RapidDiagnosticTest $rdt_recording)
    {
        $destroy = $rdt_recording->delete();
        if($destroy){
            return back()->with('success',['Berhasil menghapus']);
        }else{
            return back()->withErrors(['Gagal menghapus']);
        }
    }
}
