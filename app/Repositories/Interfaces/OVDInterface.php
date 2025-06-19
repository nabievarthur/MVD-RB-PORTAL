<?php

namespace App\Repositories\Interfaces;

use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

interface OVDInterface
{
    public function getOVDList(): Collection;

    public function getPaginatedOVD(): LengthAwarePaginator;


}
