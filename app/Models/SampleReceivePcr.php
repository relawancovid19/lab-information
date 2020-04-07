<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class SampleReceivePcr extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'registration_id',
        'sample_number',
        'rna_datetime',
        'from_lab',
        'sampling_officer',
        'pcr_operator',
        'check_start_datetime',
        'check_type',
        'check_kit',
        'gen_target',
        'check_finish_datetime',
        'result',
        'conclusion',
        'notes',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $casts = [];

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

    /**
     * Get the registration that owns the symptom.
     */
    public function registration()
    {
        return $this->belongsTo(Registration::class);
    }

    /**
     * Get the sampleNumber that owns the symptom.
     */
    public function sampleNumber()
    {
        return $this->belongsTo(SampleTypeReceiveTakingPivot::class, 'sample_number', 'sample_number');
    }

    public static function getConclusionLabel()
    {
        return [
            0 => 'Negatif',
            1 => 'Positif',
            2 => 'Tidak dapat ditentukan',
        ];
    }

    public function getConclusionLabelAttribute()
    {
        return $this->getConclusionLabel()[$this->conclusion];
    }
}
