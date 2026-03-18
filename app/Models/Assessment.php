<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Assessment extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'uuid',
        'patient_name',
        'birth_year',
        'gender',
        'phone_number',
        'previous_job',
        'height',
        'weight',
        'bmi',
        'cci_total_score',
        'minicog_total_score',
        'mna_total_score',
        'cfs_total_score',
        'morse_total_score',
        'gds_total_score',
    ];

    /**
     * Get the columns that should receive a unique identifier.
     *
     * @return array<int, string>
     */
    public function uniqueIds(): array
    {
        return ['uuid'];
    }

    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'uuid';
    }

    public function cciDetail(): HasOne
    {
        return $this->hasOne(CCIDetail::class);
    }

    public function minicogDetail(): HasOne
    {
        return $this->hasOne(MinicogDetail::class);
    }

    public function mnaDetail(): HasOne
    {
        return $this->hasOne(MNADetail::class);
    }

    public function cfsDetail(): HasOne
    {
        return $this->hasOne(CFSDetail::class);
    }

    public function morseDetail(): HasOne
    {
        return $this->hasOne(MorseDetail::class);
    }

    public function gdsDetail(): HasOne
    {
        return $this->hasOne(GDSDetail::class);
    }
}
