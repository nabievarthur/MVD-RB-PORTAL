<?php

namespace App\Repositories\Interfaces;

use App\Models\OVD;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

interface OVDInterface
{
    public function findOVDById(int $ovdId): ?OVD;

    public function getOVDCount(): int;

    public function getOVDList(): Collection;

    public function getFilterableOVD(array $data): LengthAwarePaginator;

    public function getPaginatedOVD(): LengthAwarePaginator;

    public function createOVD(array $ovdData): ?OVD;

    public function updateOVD(int $ovdId, array $ovdData): ?OVD;

    public function deleteOVD(int $ovdId): bool;
}
