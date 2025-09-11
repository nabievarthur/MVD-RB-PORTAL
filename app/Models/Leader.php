<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Leader extends Model
{
    protected $fillable = [
        'full_name',
        'rank',
        'position',
        'priority'
    ];

    public function files(): MorphMany
    {
        return $this->morphMany(File::class, 'fileable');
    }
}
