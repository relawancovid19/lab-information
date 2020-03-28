<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Patient extends Model
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
        'nik',
        'fullname',
        'date_of_birth',
        'age_year',
        'age_month',
        'gender',
        'address_1',
        'address_2',
        'phone_number',
        'answer'
    ];

    /**
     * Get the registration for the patient.
     */
    public function registration()
    {
        return $this->hasMany(Registration::class);
    }

    public function treatmentHistoryPdps()
    {
        return $this->hasMany(TreatmentHistoryPdp::class);
    }
}
