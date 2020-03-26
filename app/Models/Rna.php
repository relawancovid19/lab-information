<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Rna extends Model
{
    use SoftDeletes;

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'deleted_at',
        'taken_date_time',
        'extraction_started_date_time',
        'extraction_ended_date_time',
        'sent_date_time'
    ];

    protected $fillable = [
        'registration_number_id',
        'sample_receive_taking_id',
        'taken_date_time',
        'receiver_officer',
        'extraction_operator',
        'extraction_started_date_time',
        'extraction_method',
        'extraction_kit_name',
        'extraction_ended_date_time',
        'sent_to',
        'sender_name',
        'sent_date_time',
        'notes'
    ];

    public function registration()
    {
        return $this->hasOne(Registration::class, 'id', 'registration_number_id');
    }
}
