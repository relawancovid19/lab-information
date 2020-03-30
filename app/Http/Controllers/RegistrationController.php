<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use App\Models\Registration;
use App\Models\Symptom;
use App\Models\TreatmentHistoryPdp;
use App\Http\Requests\Registration as RegistrationRequest;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use DB;

class RegistrationController extends Controller
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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $registrations = Registration::orderBy('created_at', 'desc')->get();

        return view('pages.registration.index', compact('registrations'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $patients = Patient::get();
        $registrationNumber = Registration::nextRegistrationNumber();

        return view('pages.registration.create', compact('patients', 'registrationNumber'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Http\Requests\Registration $request
     * @return \Illuminate\Http\Response
     */
    public function store(RegistrationRequest $request)
    {
        $data = $request->all();

        // Change date format to Y-m-d
        $data['date_of_birth'] = ($data['date_of_birth'] != null) ? $data['date_of_birth'] : null;
        $data['age_year'] = ($data['age_year'] != null) ? $data['age_year'] : 0;
        $data['age_month'] = ($data['age_month'] != null) ? $data['age_month'] : 0;

        $dataTreatmentHistoryPdps = [];
        foreach ($data['explanation'] as $key => $value) {
            $dataTreatmentHistoryPdps[$key]['explanation'] = $value;
            $dataTreatmentHistoryPdps[$key]['date_treated'] = $data['date_treated'][$key];
            $dataTreatmentHistoryPdps[$key]['fasyankes_name'] = $data['fasyankes_name'][$key];
        }

        $travels = [];
        foreach ($data['travel']['date_of_visit'] as $key => $value) {
            $travels[$key] = [
                'date_of_visit' => $value,
                'city' => $data['travel']['city'][$key],
                'country' => $data['travel']['country'][$key]
            ];
        }

        $contactWithPatients = [];
        foreach ($data['contact_sick_people']['name_people_sick'] as $key => $value) {
            $contactWithPatients[$key] = [
                'name_people_sick' => $value,
                'address' => $data['contact_sick_people']['address'][$key],
                'relation' => $data['contact_sick_people']['relation'][$key],
                'contact_date' => $data['contact_sick_people']['contact_date'][$key]
            ];
        }

        // Insert Patient
        $patient = Patient::firstOrCreate(['id' => $data['patient_id']], $data);
        // Insert Registration
        $registration = $patient->registration()->create($data);
        // Insert Symptom
        $registration->symptom()->create($data);
        // insert treatmentHistoryPdp
        $patient->treatmentHistoryPdps()->createMany($dataTreatmentHistoryPdps);
        // Insert travel histories
        $registration->travelHistories()->createMany($travels);
        // Insert contact histories
        $registration->contactHistories()->createMany($contactWithPatients);

        return redirect()->route('registrations.index')->with('alert', [
            'color' => 'success',
            'message' => 'Registrasi berhasil ditambahkan!',
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param int $idRegistration
     * @return \Illuminate\Http\Response
     */
    public function show($idRegistration)
    {
        $registration = Registration::findOrFail($idRegistration);

        return view('pages.registration.show', compact('registration'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $idRegistration
     * @return \Illuminate\Http\Response
     */
    public function edit($idRegistration)
    {
        $registration = Registration::findOrFail($idRegistration);

        return view('pages.registration.edit', compact('registration', 'registrationNumber'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \App\Http\Requests\Registration $request
     * @param int $idRegistration
     * @return \Illuminate\Http\Response
     */
    public function update(RegistrationRequest $request, $idRegistration)
    {
        $data = $request->all();
        // Change date format to Y-m-d
        $data['date_of_birth'] = ($data['date_of_birth'] != null) ? Carbon::createFromFormat('d/m/Y', $data['date_of_birth'])->format('Y-m-d') : null;
        $data['registration_date'] = ($data['registration_date'] != null) ? Carbon::createFromFormat('d/m/Y', $data['registration_date'])->format('Y-m-d') : null;
        $data['age_year'] = ($data['age_year'] != null) ? $data['age_year'] : 0;
        $data['age_month'] = ($data['age_month'] != null) ? $data['age_month'] : 0;

        // Update registration
        $registration = Registration::findOrFail($idRegistration);
        $registration->update($data);
        // Update patient
        $registration->patient->update($data);
        // Update symptom
        $registration->symptom->update($data);

        return redirect()->route('registrations.index')->with('alert', [
            'color' => 'success',
            'message' => 'Registrasi berhasil diubah!',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $idRegistration
     * @return \Illuminate\Http\Response
     */
    public function destroy($idRegistration)
    {
        Symptom::whereRegistrationId($idRegistration)->delete();
        Registration::findOrFail($idRegistration)->delete();

        return redirect()->route('registrations.index')->with('msg', 'Registrasi berhasil dihapus!');
    }
}
