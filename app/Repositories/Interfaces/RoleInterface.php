<?php

namespace App\Repositories\Interfaces;

use Illuminate\Support\Collection;

interface RoleInterface
{
    public function getRolesList(): Collection;
}
