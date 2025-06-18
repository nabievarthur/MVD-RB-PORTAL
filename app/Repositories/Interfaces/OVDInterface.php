<?php

namespace App\Repositories\Interfaces;

use Illuminate\Support\Collection;

interface OVDInterface
{
    public function getOVDList(): Collection;
}
