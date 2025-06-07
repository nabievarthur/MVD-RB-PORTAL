<?php

namespace App\Repositories;

use App\Models\Subdivision;
use App\Repositories\Interfaces\SubdivisionInterface;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;

class SubdivisionRepository implements SubdivisionInterface
{
    /**
     * Create a new class instance.
     */
    public function __construct(
        protected Subdivision $model
    )
    {
    }

    public function getSubdivisionList(): Collection
    {
        return Cache::remember('subdivisions.all', 3600, function () {
            return $this->model->pluck('title', 'id');
        });
    }
}
