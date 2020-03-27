<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Registration extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            // Patient
            'nik' => 'nullable|integer',
            'fullname' => 'required',
            'date_of_birth' => 'nullable|date_format:d/m/Y',
            'age_year' => 'nullable|integer',
            'age_month' => 'nullable|integer',
            'gender' => 'nullable',
            'address_1' => 'nullable',
            'phone_number' => 'nullable|digits_between:10,15',
            // Registration
            'registration_number' => 'required|integer|unique:registrations,registration_number,'.$this->registration,
            'medical_record_number' => 'nullable',
            'dinkes_sender' => 'nullable',
            'fasyankes_sender' => 'nullable',
            'fasyankes_phone' => 'nullable|digits_between:10,15',
            'doctor' => 'nullable',
            'registration_date' => 'nullable|date_format:d/m/Y',
            // Symptoms
            'comorbid_description' => 'required_if:comorbid,true',
        ];
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array
     */
    public function attributes()
    {
        return [
            // Patient
            'fullname' => 'nama pasien',
            'date_of_birth' => 'tanggal lahir',
            'age_year' => 'umur (tahun)',
            'age_month' => 'umur (bulan)',
            'gender' => 'jenis kelamin',
            'address_1' => 'alamat',
            'phone_number' => 'nomor telepon / nomor hp',
            // Registration
            'registration_number' => 'nomor registrasi',
            'medical_record_number' => 'medical record number',
            'dinkes_sender' => 'dinkes pengirim',
            'fasyankes_sender' => 'fasyankes pengirim',
            'fasyankes_phone' => 'nomor telepon fasyankes',
            'doctor' => 'dokter penanggung jawab',
            'registration_date' => 'tanggal registrasi',
            'reference_number' => 'nomor rujukan',
            // Symptoms
            'fever' => 'panas atau riwayat panas',
            'cough' => 'batuk',
            'sore_throat' => 'nyeri tenggorokan',
            'shortness_of_breath' => 'sesak nafas',
            'flu' => 'pilek',
            'fatigue' => 'lesu',
            'headache' => 'sakit kepala',
            'diarrhea' => 'diare',
            'nausea_or_vomiting' => 'mual / muntah',
            'comorbid' => 'penyakit penyerta',
            'comorbid_description' => 'penjelasan penyakit penyerta',
            'pulmonary_xray' => 'x-ray paru',
            'using_ventilator' => 'menggunakan ventilator',
            'leukosit' => 'leukosit',
            'xray_result' => 'hasil x ray paru',
            'limfosit' => 'limfosit',
            'trombosit' => 'trombosit',
            'health_status' => 'status kesehatan',
            'hipertensi' => 'hipertensi',
            'diabetes_mellitus' => 'diabetes mellitus',
            'liver' => 'liver',
            'neurologi' => 'neurologi',
            'hiv' => 'hiv',
            'kidney' => 'ginjal',
            'chronic_lung' => 'paru kronik',
            // TreatmentHistoryPdp
            'explanation' => 'rawat keberapa',
            'fasyankes_name' => 'nama rumah sakit',
            'date_treated' => 'tanggal rawat',
            // ContactHistory
            'check_patient_journey' => 'cek perjalanan pasien',
            'date_of_visit' => 'tanggal kunjungan',
            'city' => 'kota',
            'country' => 'negara',
            'check_contact_sick_people' => 'kontak langsung dengan orang sakit',
            'name_people_sick' => 'nama orang yang sakit',
            'address' => 'alamat',
            'relation' => 'hubungan',
            'contact_date' => 'tanggal kontak',
            'check_people_infected' => 'cek orang yang terinfeksi',
            'check_family_members_infected' => 'cek anggota keluarga yang terinfeksi',
            'other' => 'lain-lain',
        ];
    }
}
