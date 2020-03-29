<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

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

    public function travelHistories()
    {
        return $this->hasMany(TravelHistory::class);
    }

    public function contactHistories()
    {
        return $this->hasMany(ContactHistory::class);
    }

    /**
     * Generate registration number.
     *
     * @return void
     */
    public static function nextRegistrationNumber()
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
}
