<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TravelHistories extends Model
{
    use SoftDeletes;

    protected $dates = [
        'deleted_at',
        'created_at',
        'updated_at',
        'date_of_visit',
    ];

    protected $fillable = [
        'registration_id',
        'date_of_visit',
        'city',
        'country',
    ];

    public function registration()
    {
        return $this->belongsTo(Registration::class);
    }
}
