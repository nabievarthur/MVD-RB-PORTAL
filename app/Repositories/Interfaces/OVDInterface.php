<?php

namespace App\Repositories\Interfaces;

use App\Models\OVD;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

interface OVDInterface
{
    public function findOVDById(int $ovdId): ?OVD;
    public function getOVDList(): Collection;

    public function getPaginatedOVD(): LengthAwarePaginator;


}
