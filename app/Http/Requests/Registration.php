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
            'nik' => 'required|integer',
            'fullname' => 'required',
            'date_of_birth' => 'required|date_format:d/m/Y',
            'age_year' => 'required|integer',
            'age_month' => 'nullable|integer',
            'gender' => 'required',
            'address_1' => 'required',
            'phone_number' => 'required|digits_between:10,15',
            // Registration
            'registration_number' => 'required|integer|unique:registrations,registration_number,'.$this->registration,
            'sample_number' => 'required',
            'dinkes_sender' => 'required',
            'fasyankes_sender' => 'required',
            'fasyankes_phone' => 'required|digits_between:10,15',
            'doctor' => 'required',
            'registration_date' => 'required|date_format:d/m/Y',
            'reference_number' => 'required',
            // Symptoms
            'fever' => 'required|boolean',
            'cough' => 'required|boolean',
            'sore_throat' => 'required|boolean',
            'shortness_of_breath' => 'required|boolean',
            'flu' => 'required|boolean',
            'fatigue' => 'required|boolean',
            'headache' => 'required|boolean',
            'diarrhea' => 'required|boolean',
            'nausea_or_vomiting' => 'required|boolean',
            'comorbid' => 'required|boolean',
            'comorbid_description' => 'required_if:comorbid,true',
            'pulmonary_xray' => 'required',
            'using_ventilator' => 'required|boolean'
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
            'sample_number' => 'nomor sampel',
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
            'using_ventilator' => 'menggunakan ventilator'
        ];
    }
}
