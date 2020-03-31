<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TreatmentHistoryPdp extends Model
{
    use SoftDeletes;

    protected $dates = [
        'deleted_at'
    ];

    protected $fillable = [
        'explanation',
        'fasyankes_name',
        'date_treated',
        'patient_id'
    ];

    public static function getTreatmentOrder()
    {
        return [
            0 => 'pertama',
            1 => 'kedua',
            2 => 'ketiga',
        ];
    }
}
