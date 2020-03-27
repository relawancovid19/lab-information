<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use App\Models\Registration;
use App\Models\Symptom;
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
        $registrationNumber = $this->nextRegistrationNumber();

        return view('pages.registration.create', compact('patients', 'registrationNumber'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Registration  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RegistrationRequest $request)
    {
        $data = $request->all();
        // Change date format to Y-m-d
        $data['date_of_birth'] = ($data['date_of_birth'] != null) ? Carbon::createFromFormat('d/m/Y', $data['date_of_birth'])->format('Y-m-d') : null;
        $data['registration_date'] = ($data['registration_date'] != null) ? Carbon::createFromFormat('d/m/Y', $data['registration_date'])->format('Y-m-d') : null;
        $data['age_year'] = ($data['age_year'] != null) ? $data['age_year'] : 0;
        $data['age_month'] = ($data['age_month'] != null) ? $data['age_month'] : 0;

        $dataTreatmentHistoryPdps = [];
        foreach ($data['explanation'] as $key => $value) {
            $dataTreatmentHistoryPdps[$key]['explanation'] = $value;
            $dataTreatmentHistoryPdps[$key]['date_treated'] = $data['date_treated'][$key];
            $dataTreatmentHistoryPdps[$key]['fasyankes_name'] = $data['fasyankes_name'][$key];
        }

        // Insert Patient
        $patient = Patient::firstOrCreate(['id' => $data['patient_id']], $data);
        // Insert Registration
        $registration = $patient->registration()->create($data);
        // Insert Symptom
        $registration->symptom()->create($data);
        // insert treatmentHistoryPdp
        $patient->treatmentHistoryPdp()->saveMany($dataTreatmentHistoryPdps);

        return redirect()->route('registrations.index')->with('alert', [
            'color' => 'success',
            'message' => 'Registrasi berhasil ditambahkan!',
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $idRegistration
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
     * @param  int  $idRegistration
     * @return \Illuminate\Http\Response
     */
    public function edit($idRegistration)
    {
        $registration = Registration::findOrFail($idRegistration);

        return view('pages.registration.edit', compact('registration'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Registration  $request
     * @param  int  $idRegistration
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
     * Generate registraion number.
     *
     * @return void
     */
    private function nextRegistrationNumber()
    {
        // Get the last created registration
        $lastRegistration = Registration::orderBy('created_at', 'desc')->first();

        if (!$lastRegistration) {
            // We get here if there is no registration at all
            // If there is no number set it to 0, which will be 1 at the end.
            $number = 0;
        } else {
            $number = substr($lastRegistration->registration_number, 8);
        }
        // If we have YYYYMMDD000001 in the database then we only want the number
        // So the substr returns this 000001

        // Add the string in front and higher up the number.
        // the %06d part makes sure that there are always 6 numbers in the string.
        // so it adds the missing zero's when needed.

        return Carbon::now()->format('Ymd') . sprintf('%06d', intval($number) + 1);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $idRegistration
     * @return \Illuminate\Http\Response
     */
    public function destroy($idRegistration)
    {
        Symptom::whereRegistrationId($idRegistration)->delete();
        Registration::findOrFail($idRegistration)->delete();

        return redirect()->route('registrations.index')->with('msg', 'Registrasi berhasil dihapus!');
    }

    public function import(Request $request)
    {
        $request->validate([
            'upload_file' => 'required|mimes:csv,txt'
        ]);

        DB::beginTransaction();

        try {
            $importFile = $request->file('upload_file');
            $archive = public_path().'/import/registration/';

            $date = date('YmdH24is');
            $newFileName = "IMPORT_REGISTRATION_$date.csv";

            $lines = file($importFile, FILE_IGNORE_NEW_LINES);
            foreach ($lines as $line) {
                $arrayCSV[] = str_getcsv($line, ";");
            }

            $dataRegistrations = array();
            $dataPatients = array();
            // $error = array();
            // $registrationNumber = $this->nextRegistrationNumber();
            foreach ($arrayCSV as $key => $value) {
                // Get data patient from file csv
                $nik = addslashes($value[6]);
                $fullname = addslashes($value[5]);
                $dob = addslashes($value[7]);
                $ageYear = addslashes($value[8]);
                $gender = addslashes($value[9]);
                $address1 = addslashes($value[11]);
                $phoneNumber = addslashes($value[12]);
                $answer = addslashes($value[10]);

                $explodeDateOfBirth = explode('/', $dob);
                $convertDateOfBirth = $explodeDateOfBirth[2]."-".$explodeDateOfBirth[1]."-".$explodeDateOfBirth[0];


                $dataPatients['nik'] = $nik;
                $dataPatients['fullname'] = $fullname;
                $dataPatients['date_of_birth'] = $convertDateOfBirth;
                $dataPatients['age_year'] = $ageYear;
                $dataPatients['gender'] = $gender;
                $dataPatients['address_1'] = $address1;
                $dataPatients['phone_number'] = $phoneNumber;
                $dataPatients['answer'] = $answer;

                // Get data registration from file csv
                $dinkesSender = addslashes($value[0]);
                $fasyankesSender = addslashes($value[2]);
                $fasyankesPhone = addslashes($value[4]);
                $doctor = addslashes($value[3]);
                $medicalRecordNumber = addslashes($value[2]);

                $dataRegistrations['dinkes_sender'] = $dinkesSender;
                $dataRegistrations['fasyankes_sender'] = $fasyankesSender;
                $dataRegistrations['fasyankes_phone'] = $fasyankesPhone;
                $dataRegistrations['doctor'] = $doctor;
                $dataRegistrations['medical_record_number'] = $medicalRecordNumber;

                $rules = [
                    'fullname' => 'required',
                    'phone_number' => 'max:15',
                    'fasyankes_phone' => 'max:15'
                ];

                $baris = $key + 1;

                $messages = [
                    'required' => 'The :attribute field is required in line '.$baris.'.',
                    'max' => 'The :attribute field digit max 15 in line '.$baris.'.',
                ];

                $validator = Validator::make($dataPatients, $rules, $messages);

                if ($validator->fails()) {
                    return redirect()->route('registrations.index')->with('msg', $validator->messages());
                }

                $patient = Patient::create($dataPatients);
                Registration::create(array_merge($dataRegistrations, [
                    'patient_id' => $patient->id,
                    'registration_number' => $this->nextRegistrationNumber()
                ]));
            }

            DB::commit();

            $request->file('upload_file')->move($archive, $newFileName);

            return redirect()->route('registrations.index')->with('msg', 'Import registrasi berhasil!');
        } catch (\Throwable $th) {
            DB::rollBack();

            return redirect()->route('registrations.index')->with('msg', $th->getMessage());
        }
    }
}
