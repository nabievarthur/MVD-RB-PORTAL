<?php

namespace App\Models\Contracts;

use App\Models\File;
use Illuminate\Database\Eloquent\Relations\MorphMany;

interface HasFiles
{
    public function files(): MorphMany;

    /**
     * @return iterable<File>
     */
    public function getFiles(): iterable;
}
