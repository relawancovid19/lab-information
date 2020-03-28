<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use App\Models\Registration;
use App\Models\Symptom;
use App\Models\ContactHistory;
use App\Models\TravelHistories;
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
        $data['date_of_birth'] = ($data['date_of_birth'] != null) ? $data['date_of_birth'] : null;
        $data['registration_date'] = ($data['registration_date'] != null) ? $data['registration_date'] : null;
        $data['age_year'] = ($data['age_year'] != null) ? $data['age_year'] : 0;
        $data['age_month'] = ($data['age_month'] != null) ? $data['age_month'] : 0;

        $dataTreatmentHistoryPdps = [];
        foreach ($data['explanation'] as $key => $value) {
            $dataTreatmentHistoryPdps[$key]['explanation'] = $value;
            $dataTreatmentHistoryPdps[$key]['date_treated'] = $data['date_treated'][$key];
            $dataTreatmentHistoryPdps[$key]['fasyankes_name'] = $data['fasyankes_name'][$key];
        }

        $travels = [];
        foreach($data['travel']['date_of_visit'] as $key => $value) {
            $travels[$key] = [
                'date_of_visit' => $value,
                'city' => $data['travel']['city'][$key],
                'country' => $data['travel']['country'][$key]
            ];
        }

        $contactWithPatients = [];
        foreach($data['contact_sick_people']['name_people_sick'] as $key => $value) {
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
        $registration->travelHistory()->createMany($travels);
        // Insert contact histories
        $registration->contactlHistory()->createMany($contactWithPatients);

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
            foreach ($arrayCSV as $key => $value) {
                // Skip header row
                if ($key < 2) {
                    continue;
                }

                // Get data patient from file csv
                $nik = addslashes($value[6]);
                $fullname = addslashes($value[5]);
                $dateOfBirth = addslashes($value[7]);
                $ageYear = addslashes($value[8]);
                $gender = addslashes($value[9]);
                $address = addslashes($value[11]);
                $phoneNumber = addslashes($value[12]);
                $answer = addslashes($value[10]);

                $explodeDateOfBirth = explode('/', $dateOfBirth);
                $convertDateOfBirth = $explodeDateOfBirth[2]."-".$explodeDateOfBirth[1]."-".$explodeDateOfBirth[0];

                $dataPatients['nik'] = $nik;
                $dataPatients['fullname'] = $fullname;
                $dataPatients['date_of_birth'] = $convertDateOfBirth;
                $dataPatients['age_year'] = $ageYear;
                $dataPatients['gender'] = $gender;
                $dataPatients['address_1'] = $address;
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
                $registration = Registration::create(array_merge($dataRegistrations, [
                    'patient_id' => $patient->id,
                    'registration_number' => $this->nextRegistrationNumber()
                ]));
                $this->setDataTreatementHistoryPdp($value, $patient->id);
                $this->setDataSymptom($value, $registration);
                $this->setDataContact($value, $patient, $registration);
                $this->setDataTravel($value, $registration);

            }

            DB::commit();

            $request->file('upload_file')->move($archive, $newFileName);

            return redirect()->route('registrations.index')->with('msg', 'Import registrasi berhasil!');
        } catch (\Throwable $th) {
            DB::rollBack();

            return redirect()->route('registrations.index')->with('msg', $th->getMessage());
        }
    }

    private function setDataTreatementHistoryPdp($data, $patientId)
    {
        $dataTreatmentHistoryPdps = array();
        // Get data treatment history pdp
        $dateTreatmentFirst = addslashes($data[13]);
        $fasyankesNameFirst = addslashes($data[14]);
        $dateTreatmentSecond = addslashes($data[15]);
        $fasyankesNameSecond = addslashes($data[16]);
        $dateTreatmentThird = addslashes($data[17]);
        $fasyankesNameThird = addslashes($data[18]);

        if (!empty($dateTreatmentFirst)) {
            $explodeTreatmentFirst = explode("/", $dateTreatmentFirst);
            $convertTreatmentFirst = $explodeTreatmentFirst[2]."-".$explodeTreatmentFirst[1]."-".$explodeTreatmentFirst[0];
            $dataTreatmentHistoryPdps[0]["date_treated"] = $convertTreatmentFirst;
        } else {
            $dataTreatmentHistoryPdps[0]["date_treated"] = null;
        }

        if (!empty($dateTreatmentSecond)) {
            $explodeTreatmentSecond = explode("/", $dateTreatmentSecond);
            $convertTreatmentSecond = $explodeTreatmentSecond[2]."-".$explodeTreatmentSecond[1]."-".$explodeTreatmentSecond[0];
            $dataTreatmentHistoryPdps[1]["date_treated"] = $convertTreatmentSecond;
        } else {
            $dataTreatmentHistoryPdps[1]["date_treated"] = null;
        }

        if (!empty($dateTreatmentThird)) {
            $explodeTreatmentThird = explode("/", $dateTreatmentThird);
            $convertTreatmentThird = $explodeTreatmentThird[2]."-".$explodeTreatmentThird[1]."-".$explodeTreatmentThird[0];
            $dataTreatmentHistoryPdps[2]["date_treated"] = $convertTreatmentThird;
        } else {
            $dataTreatmentHistoryPdps[2]["date_treated"] = null;
        }

        $dataTreatmentHistoryPdps[0]["fasyankes_name"] = $fasyankesNameFirst;
        $dataTreatmentHistoryPdps[0]["explanation"] = "first";

        $dataTreatmentHistoryPdps[1]["fasyankes_name"] = $fasyankesNameSecond;
        $dataTreatmentHistoryPdps[1]["explanation"] = "second";


        $dataTreatmentHistoryPdps[2]["fasyankes_name"] = $fasyankesNameThird;
        $dataTreatmentHistoryPdps[2]["explanation"] = "third";

        $dataTreatmentHistoryPdps[0]["patient_id"] = $patientId;
        $dataTreatmentHistoryPdps[1]["patient_id"] = $patientId;
        $dataTreatmentHistoryPdps[2]["patient_id"] = $patientId;

        TreatmentHistoryPdp::insert($dataTreatmentHistoryPdps);

        return true;
    }

    private function setDataSymptom($data, $registration)
    {
        $dataSymptoms = [];
        // F1.4 TANDA DAN GEJALA
        $dataSymptoms['date_onset'] = !empty($data[19]) ? addslashes(Carbon::createFromFormat('d/m/Y', $data[19])->format('Y-m-d')) : null;
        $dataSymptoms['fever'] = addslashes($data[20]);
        $dataSymptoms['cough'] = addslashes($data[21]);
        $dataSymptoms['sore_throat'] = addslashes($data[22]);
        $dataSymptoms['shortness_of_breath'] = addslashes($data[23]);
        $dataSymptoms['flu'] = addslashes($data[24]);
        $dataSymptoms['fatigue'] = addslashes($data[25]);
        $dataSymptoms['headache'] = addslashes($data[26]);
        $dataSymptoms['diarrhea'] = addslashes($data[27]);
        $dataSymptoms['nausea_or_vomiting'] = addslashes($data[28]);
        $dataSymptoms['other_symptoms'] = addslashes($data[29]);

        // F1.5 PEMERIKSAAN PENUNJANG
        $dataSymptoms['pulmonary_xray'] = addslashes($data[30]);
        $dataSymptoms['xray_result'] = addslashes($data[31]);
        $dataSymptoms['leukosit'] = addslashes($data[32]);
        $dataSymptoms['limfosit'] = addslashes($data[33]);
        $dataSymptoms['trombosit'] = addslashes($data[34]);
        $dataSymptoms['using_ventilator'] = addslashes($data[35]);
        $dataSymptoms['health_status'] = addslashes($data[36]);

        $dataSymptoms['hipertensi'] = addslashes($data[67]);
        $dataSymptoms['diabetes_mellitus'] = addslashes($data[68]);
        $dataSymptoms['liver'] = addslashes($data[69]);
        $dataSymptoms['neurologi'] = addslashes($data[70]);
        $dataSymptoms['hiv'] = addslashes($data[71]);
        $dataSymptoms['kidney'] = addslashes($data[72]);
        $dataSymptoms['chronic_lung'] = addslashes($data[73]);
        $dataSymptoms['check_people_infected'] = addslashes($data[44]);
        $dataSymptoms['check_family_members_infected'] = addslashes($data[66]);
        $dataSymptoms['contact_with_suspect_covid19'] = addslashes($data[65]);
        $dataSymptoms['other'] = addslashes($data[74]);

        Symptom::create(array_merge([
            'registration_id' => $registration->id
        ], $dataSymptoms));

        return true;
    }

    private function setDataContact($data, $patient, $registration)
    {
        $dataContact = [];
        // F1.6 RIWAYAT KONTAK/PAPARAN
        $dataContact[1]['check_patient_journey'] = addslashes($data[37]);
        $dataContact[1]['date_of_visit'] = !empty($data[38]) ? Carbon::createFromFormat('d/m/Y', $data[38])->format('Y-m-d') : null;
        $dataContact[1]['city'] = addslashes($data[39]);
        $dataContact[1]['country'] = addslashes($data[40]);
        $dataContact[1]['check_contact_sick_people'] = addslashes($data[44]);
        $dataContact[1]['name_people_sick'] = addslashes($data[45]);
        $dataContact[1]['address'] = addslashes($data[46]);
        $dataContact[1]['relation'] = addslashes($data[47]);
        $dataContact[1]['contact_date'] = !empty($data[48]) ? Carbon::createFromFormat('d/m/Y', $data[48])->format('Y-m-d') : null;
        $dataContact[1]['check_people_infected'] = addslashes($data[65]);
        $dataContact[1]['check_family_members_infected'] = addslashes($data[66]);
        $dataContact[1]['other'] = addslashes($data[74]);

        $dataContact[2]['check_patient_journey'] = addslashes($data[37]);
        $dataContact[2]['date_of_visit'] = !empty($data[38]) ? Carbon::createFromFormat('d/m/Y', $data[38])->format('Y-m-d') : null;
        $dataContact[2]['city'] = addslashes($data[42]);
        $dataContact[2]['country'] = addslashes($data[43]);
        $dataContact[2]['check_contact_sick_people'] = addslashes($data[44]);
        $dataContact[2]['name_people_sick'] = addslashes($data[49]);
        $dataContact[2]['address'] = addslashes($data[50]);
        $dataContact[2]['relation'] = addslashes($data[51]);
        $dataContact[2]['contact_date'] = !empty($data[52]) ? Carbon::createFromFormat('d/m/Y', $data[52])->format('Y-m-d') : null;
        $dataContact[2]['check_people_infected'] = addslashes($data[65]);
        $dataContact[2]['check_family_members_infected'] = addslashes($data[66]);
        $dataContact[2]['other'] = addslashes($data[74]);

        $dataContact[3]['check_patient_journey'] = addslashes($data[37]);
        $dataContact[3]['date_of_visit'] = !empty($data[38]) ? Carbon::createFromFormat('d/m/Y', $data[38])->format('Y-m-d') : null;
        $dataContact[3]['city'] = addslashes($data[39]);
        $dataContact[3]['country'] = addslashes($data[40]);
        $dataContact[3]['check_contact_sick_people'] = addslashes($data[44]);
        $dataContact[3]['name_people_sick'] = addslashes($data[53]);
        $dataContact[3]['address'] = addslashes($data[54]);
        $dataContact[3]['relation'] = addslashes($data[55]);
        $dataContact[3]['contact_date'] = !empty($data[56]) ? Carbon::createFromFormat('d/m/Y', $data[56])->format('Y-m-d') : null;
        $dataContact[3]['check_people_infected'] = addslashes($data[65]);
        $dataContact[3]['check_family_members_infected'] = addslashes($data[66]);
        $dataContact[3]['other'] = addslashes($data[74]);

        $dataContact[4]['check_patient_journey'] = addslashes($data[37]);
        $dataContact[4]['date_of_visit'] = !empty($data[38]) ? Carbon::createFromFormat('d/m/Y', $data[38])->format('Y-m-d') : null;
        $dataContact[4]['city'] = addslashes($data[39]);
        $dataContact[4]['country'] = addslashes($data[40]);
        $dataContact[4]['check_contact_sick_people'] = addslashes($data[44]);
        $dataContact[4]['name_people_sick'] = addslashes($data[57]);
        $dataContact[4]['address'] = addslashes($data[58]);
        $dataContact[4]['relation'] = addslashes($data[59]);
        $dataContact[4]['contact_date'] = !empty($data[60]) ? Carbon::createFromFormat('d/m/Y', $data[60])->format('Y-m-d') : null;
        $dataContact[4]['check_people_infected'] = addslashes($data[65]);
        $dataContact[4]['check_family_members_infected'] = addslashes($data[66]);
        $dataContact[4]['other'] = addslashes($data[74]);

        $dataContact[5]['check_patient_journey'] = addslashes($data[37]);
        $dataContact[5]['date_of_visit'] = !empty($data[38]) ? Carbon::createFromFormat('d/m/Y', $data[38])->format('Y-m-d') : null;
        $dataContact[5]['city'] = addslashes($data[39]);
        $dataContact[5]['country'] = addslashes($data[40]);
        $dataContact[5]['check_contact_sick_people'] = addslashes($data[44]);
        $dataContact[5]['name_people_sick'] = addslashes($data[61]);
        $dataContact[5]['address'] = addslashes($data[62]);
        $dataContact[5]['relation'] = addslashes($data[63]);
        $dataContact[5]['contact_date'] = !empty($data[64]) ? Carbon::createFromFormat('d/m/Y', $data[64])->format('Y-m-d') : null;
        $dataContact[5]['check_people_infected'] = addslashes($data[65]);
        $dataContact[5]['check_family_members_infected'] = addslashes($data[66]);
        $dataContact[5]['other'] = addslashes($data[74]);

        foreach ($dataContact as $key => $value) {
            ContactHistory::create(array_merge([
                'patient_id' => $patient->id,
                'registration_id' => $registration->id
            ], $value));
        }

        return true;
    }

    private function setDataTravel($data, $registration)
    {
        $dataTravel = [];
        $dataTravel[1]['date_of_visit'] = !empty($data[38]) ? Carbon::createFromFormat('d/m/Y', $data[38])->format('Y-m-d') : null;
        $dataTravel[1]['city'] = addslashes($data[39]);
        $dataTravel[1]['country'] = addslashes($data[40]);
        $dataTravel[2]['date_of_visit'] = !empty($data[41]) ? Carbon::createFromFormat('d/m/Y', $data[41])->format('Y-m-d') : null;
        $dataTravel[2]['city'] = addslashes($data[42]);
        $dataTravel[2]['country'] = addslashes($data[43]);

        foreach ($dataTravel as $key => $value) {
            TravelHistories::create(array_merge([
                'registration_id' => $registration->id
            ], $value));
        }

        return true;
    }
}
