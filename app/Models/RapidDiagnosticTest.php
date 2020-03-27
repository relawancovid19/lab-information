<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RapidDiagnosticTest extends Model
{
    protected $fillable = [
        'patient_id',
        'date_fever_first',
        'first_test_date',
        'first_serum_sample_number',
        'first_whole_blood_sample_number',
        'first_serum_result',
        'first_whole_blood_result',
        'first_analyst',
        'first_notes',
        'second_test_date',
        'second_serum_sample_number',
        'second_whole_blood_sample_number',
        'second_serum_result',
        'second_whole_blood_result',
        'second_analyst',
        'second_notes'
    ];
    public function patient(){
        return $this->belongsTo(Patient::class,'patient_id');
    }
}
