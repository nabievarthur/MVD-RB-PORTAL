<?php

namespace App\Repositories;

use App\Models\Role;
use App\Repositories\Interfaces\RoleInterface;
use Cache;
use Illuminate\Support\Collection;

class RoleRepository implements RoleInterface
{
    /**
     * Create a new class instance.
     */
    public function __construct(
        protected Role $model
    )
    {
    }

    public function getRolesList(): Collection
    {
        return Cache::remember('roles.all', 3600, function () {
            return $this->model
                ->orderBy('title', 'desc')
                ->pluck('title', 'id');
        });

    }
}
