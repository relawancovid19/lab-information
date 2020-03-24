<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class SampleReceiveTaking extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'registration_number',
        'sample_taken',
        'sample_taken_from_fasyankes',
        'sample_receiver_officer',
        'notes',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $casts = [
        'sample_taken' => "boolean",
        'sample_taken_from_fasyankes' => "boolean",
    ];

    public $timestamps = false;

    public function __get($key)
    {
        if (in_array(Str::snake($key), $this->fillable)) {
            return $this->attributes[Str::snake($key)];
        }
        return parent::__get($key);
    }

    public function __set($key, $value)
    {
        if (in_array(Str::snake($key), $this->fillable)) {
            $this->attributes[Str::snake($key)] = $value;
            return;
        }

        parent::__set($key, $value);
    }

    public function sampleTypes()
    {
        return $this->belongsToMany(SampleType::class, 'sample_type_receive_taking_pivots')
            ->using(SampleTypeReceiveTakingPivot::class)
            ->withPivot([
                'is_done',
                'sampling_officer',
                'sampling_date',
                'sample_number',
            ]);
    }
}
