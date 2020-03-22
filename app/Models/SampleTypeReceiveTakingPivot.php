<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Support\Str;

class SampleTypeReceiveTakingPivot extends Pivot
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'is_done', 'sampling_officer',
        'sampling_date', 'sample_number',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'done' => 'boolean',
        'sampling_date' => 'datetime',
    ];

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
}
