<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OtherDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'assessment_id',
        'has_drug_allergy',
        'drug_allergy_detail',
        'has_sensory_impairment',
        'has_incontinence',
        'has_pressure_ulcer_risk',
        'has_caregiver',
    ];

    public function assessment(): BelongsTo
    {
        return $this->belongsTo(Assessment::class);
    }
}
