<?php

namespace App\Repositories\Interfaces;

use Illuminate\Support\Collection;

interface SubdivisionInterface
{
    public function getSubdivisionList(): Collection;

}
