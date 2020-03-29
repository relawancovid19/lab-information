<?php
namespace App\Http\Controllers;

use App\Models\Patient;
use App\Models\Registration;
use App\Models\Symptom;
use App\Models\ContactHistory;
use App\Models\TravelHistories;
use App\Models\TreatmentHistoryPdp;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use DB;

class ImportRegistrationController extends Controller
{
    private $csvColumnMapPatient = [
        6 => 'nik',
        5 => 'fullname',
        7 => 'date_of_birth',
        8 => 'age_year',
        9 => 'gender',
        11 => 'address_1',
        12 => 'phone_number',
        10 => 'answer',
    ];

    private $csvColumnMapRegistration = [
        0 => 'dinkes_sender',
        2 => 'fasyankes_sender',
        4 => 'fasyankes_phone',
        3 => 'doctor',
        2 => 'medical_record_number',
    ];

    private $csvColumnMapTreatment = [
        0 => [
            13 => 'date_treated',
            14 => 'fasyankes_name',
        ],
        1 => [
            15 => 'date_treated',
            16 => 'fasyankes_name',
        ],
        2 => [
            17 => 'date_treated',
            18 => 'fasyankes_name',
        ]
    ];

    private $csvColumnMapSymptom = [
        19 => 'date_onset',
        20 => 'fever',
        21 => 'cough',
        22 => 'sore_throat',
        23 => 'shortness_of_breath',
        24 => 'flu',
        25 => 'fatigue',
        26 => 'headache',
        27 => 'diarrhea',
        28 => 'nausea_or_vomiting',
        29 => 'other_symptoms',

        30 => 'pulmonary_xray',
        31 => 'xray_result',
        32 => 'leukosit',
        33 => 'limfosit',
        34 => 'trombosit',
        35 => 'using_ventilator',
        36 => 'health_status',

        67 => 'hipertensi',
        68 => 'diabetes_mellitus',
        69 => 'liver',
        70 => 'neurologi',
        71 => 'hiv',
        72 => 'kidney',
        73 => 'chronic_lung',
        44 => 'check_people_infected',
        66 => 'check_family_members_infected',
        65 => 'contact_with_suspect_covid19',
        74 => 'other',
    ];

    private $csvColumnMapContact = [
        0 => [
            37 => 'check_patient_journey',
            38 => 'date_of_visit',
            39 => 'city',
            40 => 'country',
            44 => 'check_contact_sick_people',
            45 => 'name_people_sick',
            46 => 'address',
            47 => 'relation',
            48 => 'contact_date',
            65 => 'check_people_infected',
            66 => 'check_family_members_infected',
            74 => 'other',
        ],
        1 => [
            37 => 'check_patient_journey',
            38 => 'date_of_visit',
            42 => 'city',
            43 => 'country',
            44 => 'check_contact_sick_people',
            49 => 'name_people_sick',
            50 => 'address',
            51 => 'relation',
            52 => 'contact_date',
            65 => 'check_people_infected',
            66 => 'check_family_members_infected',
            74 => 'other',
        ],
        2 => [
            37 => 'check_patient_journey',
            38 => 'date_of_visit',
            39 => 'city',
            40 => 'country',
            44 => 'check_contact_sick_people',
            53 => 'name_people_sick',
            54 => 'address',
            55 => 'relation',
            56 => 'contact_date',
            65 => 'check_people_infected',
            66 => 'check_family_members_infected',
            74 => 'other',
        ],
        3 => [
            37 => 'check_patient_journey',
            38 => 'date_of_visit',
            39 => 'city',
            40 => 'country',
            44 => 'check_contact_sick_people',
            57 => 'name_people_sick',
            58 => 'address',
            59 => 'relation',
            60 => 'contact_date',
            65 => 'check_people_infected',
            66 => 'check_family_members_infected',
            74 => 'other',
        ],
        4 => [
            37 => 'check_patient_journey',
            38 => 'date_of_visit',
            39 => 'city',
            40 => 'country',
            44 => 'check_contact_sick_people',
            61 => 'name_people_sick',
            62 => 'address',
            63 => 'relation',
            64 => 'contact_date',
            65 => 'check_people_infected',
            66 => 'check_family_members_infected',
            74 => 'other',
        ],
    ];

    private $csvColumnMapTravel = [
        0 => [
            38 => 'date_of_visit',
            39 => 'city',
            40 => 'country',
        ],
        1 => [
            41 => 'date_of_visit',
            42 => 'city',
            43 => 'country',
        ]
    ];

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
                $dataPatients = $this->extractDataPatient($value);

                // Get data registration from file csv
                $dataRegistrations = $this->extractDataRegistration($value);

                // Get data symptom from file csv
                $dataSymptoms = $this->extractDataSymptom($value);

                // Get data treatment history from file csv
                $dataTreatmentHistoryPdps = $this->extractDataTreatementHistoryPdp($value);

                // Get data travel history from file csv
                $dataTravel = $this->extractDataTravel($value);

                // Get data contact history from file csv
                $dataContact = $this->extractDataContact($value);

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

                // Insert Patient
                $patient = Patient::create($dataPatients);

                // Insert Registration
                $registration = Registration::create(array_merge($dataRegistrations, [
                    'patient_id' => $patient->id,
                    'registration_number' => Registration::nextRegistrationNumber()
                ]));

                // Insert Symptom
                $registration->symptom()->create($dataSymptoms);

                // insert treatmentHistoryPdp
                $patient->treatmentHistoryPdps()->createMany($dataTreatmentHistoryPdps);

                // Insert travel histories
                $registration->travelHistory()->createMany($dataTravel);

                // Insert contact histories
                $registration->contactlHistory()->createMany($dataContact);
            }

            DB::commit();

            $request->file('upload_file')->move($archive, $newFileName);

            return redirect()->route('registrations.index')->with('msg', 'Import registrasi berhasil!');
        } catch (\Throwable $th) {
            DB::rollBack();

            return redirect()->route('registrations.index')->with('msg', $th->getMessage());
        }
    }

    private function extractDataPatient($data)
    {
        $dataPatients = [];
        foreach ($this->csvColumnMapPatient as $key => $value) {
            $dataPatients[$value] = $this->formatData($data[$key]);
        }

        return $dataPatients;
    }

    private function extractDataRegistration($data)
    {
        $dataRegistrations = [];
        foreach ($this->csvColumnMapRegistration as $key => $value) {
            $dataRegistrations[$value] = $this->formatData($data[$key]);
        }

        return $dataRegistrations;
    }

    private function extractDataTreatementHistoryPdp($data)
    {
        $dataTreatmentHistoryPdps = array();
        foreach ($this->csvColumnMapTreatment as $row => $arrayTreatment) {
            foreach ($arrayTreatment as $key => $value) {
                $dataTreatmentHistoryPdps[$row][$value] = $this->formatData($data[$key]);
                $dataTreatmentHistoryPdps[$row]['explanation'] = $this->convertKeyToOrder($row);
            }
        }

        return $dataTreatmentHistoryPdps;
    }

    private function extractDataSymptom($data)
    {
        $dataSymptoms = [];
        foreach ($this->csvColumnMapSymptom as $key => $value) {
            $dataSymptoms[$value] = $this->formatData($data[$key]);
        }

        return $dataSymptoms;
    }

    private function extractDataContact($data)
    {
        $dataContact = array();
        foreach ($this->csvColumnMapContact as $row => $arrayContact) {
            foreach ($arrayContact as $key => $value) {
                $dataContact[$row][$value] = $this->formatData($data[$key]);
            }
        }

        return $dataContact;
    }

    private function extractDataTravel($data)
    {
        $dataTravel = array();
        foreach ($this->csvColumnMapTravel as $row => $arrayTravel) {
            foreach ($arrayTravel as $key => $value) {
                $dataTravel[$row][$value] = $this->formatData($data[$key]);
            }
        }

        return $dataTravel;
    }

    private function formatData($data)
    {
        if (!isset($data)) {
            return null;
        }

        if (preg_match("/^(0[1-9]|[1-2][0-9]|3[0-1])\/(0[1-9]|1[0-2])\/[0-9]{4}$/", $data)) {
            return $this->convertToIsoDate($data);
        }

        return addslashes($data);
    }

    private function convertToIsoDate($data)
    {
        return isset($data) ? Carbon::createFromFormat('d/m/Y', $data)->format('Y-m-d') : '0000-00-00';
    }

    private function convertKeyToOrder($key)
    {
        $arrayOrder = [
            0 => 'first',
            1 => 'second',
            2 => 'third'
        ];

        return $arrayOrder[$key];
    }
}
