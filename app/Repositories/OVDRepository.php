<?php

namespace App\Repositories;

use App\Models\OVD;
use App\Repositories\Interfaces\OVDInterface;
use Cache;
use Illuminate\Support\Collection;

class OVDRepository implements OVDInterface
{
    /**
     * Create a new class instance.
     */
    public function __construct(
        protected OVD $model
    )
    {
    }

    public function getOVDList(): Collection
    {
        return Cache::remember('ovd.all', 3600, function () {
            return $this->model
                ->orderBy('title', 'desc')
                ->pluck('title', 'id');
        });

    }
}
