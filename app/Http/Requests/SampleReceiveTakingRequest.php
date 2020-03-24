<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SampleReceiveTakingRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'registration_number' => 'required|integer|exists:registrations,registration_number',
            'sample_taken' => 'required|boolean',
            'sample_taken_from_fasyankes' => 'required|boolean',
            'sample_receiver_officer' => 'required|string',

            'sample_type.*.id_done' => 'boolean',
            'sample_type.*.sampling_officer' => 'nullable|string',
            'sample_type.*.sampling_date' => 'nullable|date',
            'sample_type.*.sample_number' => 'nullable|string',

            'notes' => 'string',
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
            'registration_number' => 'nomor registrasi',
            'sample_taken' => 'sampel diambil',
            'sample_taken_from_fasyankes' => 'sampel diambil dari fasyankes',
            'sample_receiver_officer' => 'petugas penerima',

            'sample_type.*.id_done' => 'sampel dilakukan',
            'sample_type.*.sampling_officer' => 'penerima sampel',
            'sample_type.*.sampling_date' => 'tanggal sampling',
            'sample_type.*.sample_number' => 'nomor sampel',

            'notes' => 'catatan',
        ];
    }
}
