<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SampleType extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'sample_name', 'slug_sample_name',
    ];

    protected $hidden = [
        'is_default',
    ];

    public $timestamps = false;

    public function getSampleNameAttribute() {
        return $this->attributes['sample_name'];
    }

    public function setSampleNameAttribute(string $sampleName) {
        $this->attributes['sample_name'] = $sampleName;
    }

    public function getSlugSampleNameAttribute() {
        return $this->attributes['slug_sample_name'];
    }

    public function setSlugSampleNameAttribute(string $slugName) {
        $this->attributes['slug_sample_name'] = $slugName;
    }
}
