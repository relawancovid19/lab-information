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
        'registration_id'
    ];

    /**
     * Get the registration that owns the symptom.
     */
    public function registration()
    {
        return $this->belongsTo(Registration::class);
    }
}
