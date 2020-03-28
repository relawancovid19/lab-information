<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Registration extends Model
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
       'registration_number',
       'dinkes_sender',
       'fasyankes_sender',
       'fasyankes_phone',
       'doctor',
       'registration_date',
       'reference_number',
       'patient_id',
       'medical_record_number',
    ];

    /**
     * Get the patient that owns the registration.
     */
    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    /**
     * Get the symptom record associated with the registration.
     */
    public function symptom()
    {
        return $this->hasOne(Symptom::class);
    }

    public function travelHistory()
    {
        return $this->hasMany(TravelHistories::class);
    }

    public function contactlHistory()
    {
        return $this->hasMany(ContactHistory::class);
    }
}
