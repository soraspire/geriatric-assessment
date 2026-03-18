<?php

namespace App\Interfaces;

use App\Models\Assessment;

interface AssessmentRepositoryInterface
{
    public function create(array $data): Assessment;
    public function findByUuid(string $uuid): ?Assessment;
    public function paginateWithFilters(array $filters, int $perPage = 10);
    public function getAll();
}
