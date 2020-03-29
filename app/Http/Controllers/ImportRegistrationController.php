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
            13 => 'date_treated_1',
            14 => 'fasyankes_name_1',
        ],
        1 => [
            15 => 'date_treated_2',
            16 => 'fasyankes_name_2',
        ],
        2 => [
            17 => 'date_treated_3',
            18 => 'fasyankes_name_3',
        ]
    ];

    private $csvColumnMapSymptom = [
        6 => 'nik',
    ];

    private $csvColumnMapContact = [
        6 => 'nik',
    ];

    private $csvColumnMapTravel = [
        6 => 'nik',
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
                    'registration_number' => Registration::nextRegistrationNumber()
                ]));

                $dataTreatmentHistoryPdps = $this->extractDataTreatementHistoryPdp($value, $patient);
                foreach ($dataTreatmentHistoryPdps as $key => $value) {
                    TreatmentHistoryPdp::create($value);
                }

                // $this->setDataSymptom($value, $registration);
                // $this->setDataContact($value, $patient, $registration);
                // $this->setDataTravel($value, $registration);

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

    private function extractDataTreatementHistoryPdp($data, $patient)
    {
        $dataTreatmentHistoryPdps = array();
        // Get data treatment history pdp
        foreach ($this->csvColumnMapTreatment as $row => $arrayTreatment) {
            foreach ($arrayTreatment as $key => $value) {
                $dataTreatmentHistoryPdps[$row][preg_replace('/_[0-3]$/', '', $value)] = $this->formatData($data[$key]);
                $dataTreatmentHistoryPdps[$row]['explanation'] = $this->convertKeyToOrder($row);
                $dataTreatmentHistoryPdps[$row]['patient_id'] = $patient->id;
            }
        }

        return $dataTreatmentHistoryPdps;
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

        foreach ($dataContact as $value) {
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

        foreach ($dataTravel as $value) {
            TravelHistories::create(array_merge([
                'registration_id' => $registration->id
            ], $value));
        }

        return true;
    }

    private function formatData($data)
    {
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
