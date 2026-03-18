<?php

namespace App\Repositories;

use App\Interfaces\AssessmentRepositoryInterface;
use App\Models\Assessment;
use Illuminate\Support\Facades\DB;

class AssessmentRepository implements AssessmentRepositoryInterface
{
    public function create(array $data): Assessment
    {
        return DB::transaction(function () use ($data) {
            $assessment = Assessment::create($data['main']);
            
            $assessment->cciDetail()->create($data['cci']);
            $assessment->minicogDetail()->create($data['minicog']);
            $assessment->mnaDetail()->create($data['mna']);
            $assessment->cfsDetail()->create($data['cfs']);
            $assessment->morseDetail()->create($data['morse']);
            
            return $assessment;
        });
    }

    public function findByUuid(string $uuid): ?Assessment
    {
        return Assessment::where('uuid', $uuid)->with([
            'cciDetail', 
            'minicogDetail', 
            'mnaDetail', 
            'cfsDetail', 
            'morseDetail'
        ])->first();
    }

    public function paginateWithFilters(array $filters, int $perPage = 10)
    {
        $query = Assessment::query();

        if (!empty($filters['name'])) {
            $query->where('patient_name', 'like', '%' . $filters['name'] . '%');
        }

        if (!empty($filters['age'])) {
            $currentYear = date('Y');
            $birthYearLimit = $currentYear - (int)$filters['age'];
            $query->where('birth_year', '<=', $birthYearLimit);
        }

        if (!empty($filters['gender'])) {
            $query->where('gender', $filters['gender']);
        }

        return $query->latest()->paginate($perPage);
    }

    public function getAll()
    {
        return Assessment::latest()->get();
    }
}
