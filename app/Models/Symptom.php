<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Symptom extends Model
{
    use SoftDeletes;

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'deleted_at'
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'fever',
        'cough',
        'sore_throat',
        'shortness_of_breath',
        'flu',
        'fatigue',
        'headache',
        'diarrhea',
        'nausea_or_vomiting',
        'comorbid',
        'comorbid_description',
        'other_symptoms',
        'pulmonary_xray',
        'using_ventilator',
        'registration_id',
        'leukosit',
        'xray_result',
        'limfosit',
        'trombosit',
        'health_status',
        'hipertensi',
        'diabetes_mellitus',
        'liver',
        'neurologi',
        'hiv',
        'kidney',
        'chronic_lung',
        'check_people_infected',
        'check_family_members_infected',
        'contact_with_suspect_covid19',
        'date_onset',
        'note'
    ];

    /**
     * Get the registration that owns the symptom.
     */
    public function registration()
    {
        return $this->belongsTo(Registration::class);
    }
}
