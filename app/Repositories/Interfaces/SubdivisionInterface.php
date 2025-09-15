<?php

namespace App\Repositories\Interfaces;

use App\Models\Subdivision;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

interface SubdivisionInterface
{
    public function findSubdivisionById(int $subdivisionId): ?Subdivision;

    public function getSubdivisionCount(): int;

    public function getSubdivisionList(): Collection;

    public function getFilterableSubdivision(array $data): LengthAwarePaginator;

    public function getPaginatedSubdivision(): LengthAwarePaginator;

    public function createSubdivision(array $subdivisionData): ?Subdivision;

    public function updateSubdivision(int $subdivisionId, array $subdivisionData): ?Subdivision;

    public function deleteSubdivision(int $subdivisionId): bool;
}
