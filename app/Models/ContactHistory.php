<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ContactHistory extends Model
{
    use SoftDeletes;

    protected $dates = [
        'deleted_at'
    ];

    protected $fillable = [
        'registration_id',
        'patient_id',
        'check_patient_journey',
        'date_of_visit',
        'city',
        'country',
        'check_contact_sick_people',
        'name_people_sick',
        'address',
        'relation',
        'contact_date',
        'check_people_infected',
        'check_family_members_infected',
        'other',
    ];

    public function registration()
    {
        return $this->belongsTo(Registration::class);
    }
}
