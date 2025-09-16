<?php

namespace App\Models\Contracts;

use Illuminate\Database\Eloquent\Relations\MorphMany;

interface HasFiles
{
    public function files(): MorphMany;
}
